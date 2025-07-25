<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends BaseController
{
    public function __construct()
    {
        $this->title = "Product";
        $this->resources = "products.";
        $this->route = "products";
        parent::__construct();
    }

    public function index(Request $request)
    {
        $info = $this->crudInfo();
        $info['products'] = Product::with('category', 'badge')->get();
        return view($this->indexResource(), $info);
    }



    public function create()
    {
        $info = $this->crudInfo();
        $info['categories'] = Category::all();
        $info['badges'] = Badge::all();
        return view($this->createResource(), $info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'parent_id' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'badge_id' => 'nullable|exists:badges,id',
            'price' => 'required|string',
            'thumb_images_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'stock' => 'required|string',
            'status' => 'required|in:active,inactive',
            'is_variant' => 'required|string',
            'size' => 'required|string',
            'color' => 'required|string',
            'specifications' => 'required|string',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->fill($validated);

        // 🖼️ Handle thumbnail upload
        if ($request->hasFile('thumb_images_url')) {
            $image = $request->file('thumb_images_url');
            $path = $image->store('products', 'public');
            $product->thumb_images_url = $path;
        } else {
            $product->thumb_images_url = 'images/img.png';
        }

        // 🖼️ Handle multiple gallery image uploads
        $galleryImages = [];

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryPath = $galleryImage->store('products/gallery', 'public');
                $galleryImages[] = $galleryPath;
            }
            $product->image_urls = $galleryImages; // Casted to JSON
        }

        $product->save();

        return redirect()->route($this->route . 'index')->with('success', 'Product created successfully.');
    }


    public function edit(string $id)
    {
        $info = $this->crudInfo();
        $info['product'] = Product::findOrFail($id);
        $info['categories'] = Category::all();
        $info['badges'] = Badge::all();
        return view($this->editResource(), $info);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'parent_id' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'badge_id' => 'nullable|exists:badges,id',
            'price' => 'required|string',
            'thumb_images_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'stock' => 'required|string',
            'status' => 'required|in:active,inactive',
            'is_variant' => 'required|string',
            'size' => 'required|string',
            'color' => 'required|string',
            'specifications' => 'required|string',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->fill($validated);

        // 🔄 Handle thumbnail update
        if ($request->hasFile('thumb_images_url')) {
            if ($product->thumb_images_url) {
                Storage::disk('public')->delete($product->thumb_images_url);
            }

            $image = $request->file('thumb_images_url');
            $path = $image->store('products', 'public');
            $product->thumb_images_url = $path;
        }

        // 🔄 Handle gallery image updates
        if ($request->hasFile('gallery_images')) {
            // Optionally delete old gallery images
            if ($product->image_urls) {
                foreach ($product->image_urls as $oldImg) {
                    Storage::disk('public')->delete($oldImg);
                }
            }

            $galleryImages = [];
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryPath = $galleryImage->store('products/gallery', 'public');
                $galleryImages[] = $galleryPath;
            }

            $product->image_urls = $galleryImages;
        }

        $product->save();

        return redirect()->route($this->route . 'index')->with('success', 'Product updated successfully.');
    }

    public function show(string $id)
    {
        $info = $this->crudInfo();
        $info['product'] = Product::with(['category', 'badge'])->findOrFail($id);
        return view($this->showResource(), $info);
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete thumbnail
        if ($product->thumb_images_url) {
            Storage::disk('public')->delete($product->thumb_images_url);
        }

        // Delete gallery images
        if (!empty($product->image_urls)) {
            foreach ($product->image_urls as $imgPath) {
                Storage::disk('public')->delete($imgPath);
            }
        }

        $product->delete();

        return redirect()->route($this->route . 'index')->with('success', 'Product deleted successfully.');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::with('badge') // 👈 Eager load badge here
        ->where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();

        return view('search', compact('products', 'query'));
    }

    public function searching(Request $request)
    {
        $query = $request->get('query');

        $results = Product::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhere('color', 'LIKE', "%{$query}%")
            ->orWhere('size', 'LIKE', "%{$query}%")
            ->get();

        return view('products.searchresult', ['entries' => $results])->render();
    }
//

}
//
//    public function searchProducts(Request $request, $view = 'search') {
//        $query = $request->input('query');
//
//        $results = Product::where('title', 'LIKE', "%{$query}%")
//            ->orWhere('description', 'LIKE', "%{$query}%")
//            ->orWhere('color', 'LIKE', "%{$query}%")
//            ->orWhere('size', 'LIKE', "%{$query}%")
//            ->get();
//
//        if ($view === 'search') {
//            return view('search', compact('results', 'query'));
//        } elseif ($view === 'ajax') {
//            return view('products.searchresult', ['entries' => $results])->render();
//        }
//
//        abort(404); // fallback if view param is invalid
//    }
//}
//
//    // Add to Cart
