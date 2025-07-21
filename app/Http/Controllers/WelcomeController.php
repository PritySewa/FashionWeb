<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Category;
use App\Models\Home;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function create()
    {
        $products = Product::all();
        $categories = Category::all();
        $badge = Badge::all();
        $home = Home::latest()->first(); // or Home::find(1) if you want a specific one

        return view('welcome', compact('products','home','categories','badge'));
    }


    public function show($id)
    {
        $products = Product::findorfail($id); // ✅ Gets a single product by ID
        return view('users.product', compact('products'));
    }
}
