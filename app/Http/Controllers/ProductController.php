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
//        dd($request->file('gallery_images'));
        $validated = $request->validate([
            'title' => 'required|string',
            'parent_id' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'badge_id' => 'nullable|exists:badges,id',
            'price' => 'required|string',
            'thumb_images_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'stock' => 'required|string',
            'status' => 'required|in:active,inactive',
            'is_variant' => 'required|string',
            'size' => 'required|string',
            'color' => 'required|string',
            'specifications' => 'required|string',
        ]);

        // 🔵 Store thumbnail
        $thumbPath = $request->file('thumb_images_url')->store('products', 'public');
        $validated['thumb_images_url'] = $thumbPath;

        // 🔵 Store gallery images
        $galleryUrls = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('gallery', 'public');
                $galleryUrls[] = '/storage/' . $path;
            }
        }
        $validated['image_urls'] = array_values(array_unique(array_filter($galleryUrls)));
//        dd($validated['image_urls']);

        // 💾 Save product to DB
        Product::create($validated);

        return redirect()->route($this->route . 'index')
            ->with('success', 'Product created successfully with multiple images.');
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
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'stock' => 'required|string',
            'status' => 'required|in:active,inactive',
            'is_variant' => 'required|string',
            'size' => 'required|string',
            'color' => 'required|string',
            'specifications' => 'required|string',
        ]);

        // 🔄 Replace thumbnail if new one uploaded
        if ($request->hasFile('thumb_images_url')) {
            if ($product->thumb_images_url) {
                Storage::disk('public')->delete($product->thumb_images_url);
            }
            $path = $request->file('thumb_images_url')->store('products', 'public');
            $validated['thumb_images_url'] = $path;
        }

        // 🔄 Replace gallery images if new ones uploaded, otherwise retain existing
        if ($request->hasFile('gallery_images')) {
            $galleryUrls = [];
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('gallery', 'public');
                $galleryUrls[] = '/storage/' . $path;
            }
            $validated['image_urls'] = array_values(array_unique(array_filter($galleryUrls)));
        } else {
            $validated['image_urls'] = $product->image_urls; // Preserve old images
        }

        // 💾 Save update
        $product->update($validated);

        return redirect()->route($this->route . 'index')
            ->with('success', 'Product updated successfully.');
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

        // Delete gallery images — no json_decode needed
        if ($product->image_urls) {
            foreach ($product->image_urls as $imgPath) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $imgPath));
            }
        }

        $product->delete();

        return redirect()->route($this->route . 'index')
            ->with('success', 'Product and associated images deleted.');
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
