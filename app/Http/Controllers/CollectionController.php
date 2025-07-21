<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function show()
    {
        $products = Product::all();
        return view('collection', compact('products'));
    }
    public function filter(Request $request)
    {
        $category = $request->query('category');

        if ($category === 'all') {
            $products = Product::latest()->get();
        } else {
            $products = Product::where('category', $category)->latest()->get();
        }

        return view('product-grid', compact('products'));
    }

}
