<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }


    public function show($id)
    {

        $products = Product::findOrFail($id); // ✅ Gets a single product by ID
        return view('users.product', compact('products'));
    }
}
