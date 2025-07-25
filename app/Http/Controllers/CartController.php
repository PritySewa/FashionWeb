<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        $existingCart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingCart) {
            $existingCart->quantity += $request->quantity;
            $existingCart->total_price = $existingCart->quantity * $product->price;
            $existingCart->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'product_title' => $product->title,
                'product_price' => $product->price,
                'quantity' => $request->quantity,
                'total_price' => $product->price * $request->quantity,
                'thumb_images_url' => $product->thumb_images_url,
                'color' => $request->color ?? null,
                'size' => $request->size ?? null
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        return view('users.cart.index', compact('cartItems'));


    }

    public function destroy($id)
    {
        $cartItem = Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        $cartItem = Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $product = Product::findOrFail($cartItem->product_id);

        $cartItem->update([
            'quantity' => $request->quantity,
            'total_price' => $product->price * $request->quantity
        ]);

        return response()->json([
            'success' => true,
            'item_total' => number_format($cartItem->total_price, 2),
            'cart_total' => number_format(auth()->user()->cartItems()->sum('total_price'), 2),
            'item_count' => auth()->user()->cartItems()->sum('quantity')
        ]);
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'item_ids' => 'required|array',
            'item_ids.*' => 'exists:carts,id'
        ]);

        Cart::whereIn('id', $request->item_ids)
            ->where('user_id', auth()->id())
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Selected items removed from cart');
    }
}
