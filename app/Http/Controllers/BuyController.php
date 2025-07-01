<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
class BuyController extends Controller
{
    public function buyNow(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $total = $product->price * $quantity;

        // Optional: Store to a temporary order table or session
        session([
            'buy_now' => [
                'product_id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
                'quantity' => $quantity,
                'total' => $product->price * $request->$quantity,
                'thumb_images_url' => $product->thumb_images_url,
            ]
        ]);

        return view('users.buy', [
            'product' => $product,
            'quantity' => $quantity,
            'total' => $total,
        ]);
    }
}
