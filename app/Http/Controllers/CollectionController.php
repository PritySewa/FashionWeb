<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
//    public function show()
//    {
//        $products = Product::all();
//        return view('collection', compact('products'));
//    }

    public function index(Request $request)
    {
        // Get all categories
        $categories = Category::all();
        $badges = Badge::all();
        $products = Product::all();

        // Base query
        $query = Product::query();

        // Apply category filter
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        if($request->has('badge')){
            $query->where('badge_id',$request->badge);
        }
        // Apply size filter
        if ($request->has('size')) {
            $query->where('size', $request->size); // Assuming 'size' column exists with values like 'S', 'M', 'L'
        }

        // Apply price range filter
        if ($request->has('price_range')) {
            if ($request->price_range === 'cheap') {
                $query->where('price', '<=', 1000);
            } elseif ($request->price_range === 'mid') {
                $query->whereBetween('price', [1001, 5000]);
            } elseif ($request->price_range === 'expensive') {
                $query->where('price', '>', 5000);
            }
        }



        // Fetch products
        $products = $query->get();

        return view('collection', compact('products', 'categories','badges','products'));
    }


}
