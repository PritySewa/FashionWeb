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

}
