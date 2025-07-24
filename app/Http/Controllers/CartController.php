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

        // Optional: Check if product already exists in user's cart
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
                'product_id' => $product->id, // ✅ This was missing
                'product_title' => $product->title,
                'product_price' => $product->price,
                'quantity' => $request->quantity,
                'total_price' => $product->price * $request->quantity,
                'thumb_images_url' => $product->thumb_images_url,
            ]);
        }
        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }
//    public function cartQuantity()
//    {
//        $userId = auth()->id();
//        $quantity = $userId ? Cart::where('user_id', $userId)->sum('quantity') : 0;
//        return response()->json(['quantity' => $quantity]);
//    }
    public function cartQuantity()
    {
        // Get total quantity of items in the cart for the logged-in user
        $quantity = Cart::where('user_id', auth()->id())->sum('quantity');

        return response()->json(['quantity' => $quantity]);
    }


    public function index()
    {

        $cartItems = Cart::where('user_id', auth()->id())->get();

        return view('users.cart.index', compact('cartItems'));
    }

    public function destroy($id)
{
    $cartItem = \App\Models\Cart::findOrFail($id);

    // Optional: check if the cart item belongs to the current user
    if ($cartItem->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }
    $cartItem->delete();

    return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
}
}


