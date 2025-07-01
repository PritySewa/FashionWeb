<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BadgeController extends BaseController
{
    public function  __construct(){
        $this->title = "Badge";
        $this->resources = "badges.";
        $this->route = "badges";
        parent::__construct();

    }

    public function index()
    {
        $info = $this->crudInfo();
        $info['badges'] = Badge::latest()->get();
        return view($this->indexResource(), $info);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = $this->crudInfo();
        return view($this->createResource(), $info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $path = $request->file('icon_image')->store('badges', 'public');

        Badge::create([
            'title' => $validated['title'],
            'icon_path' => $path,
            'description' => $validated['description'],
        ]);

        return redirect()->route($this->route . 'index')->with('success', 'Badge created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Badge $badge)
    {
        return view($this->showResource(), compact('badge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Badge $badge)
    {
        return view($this->editResource(), compact('badge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Badge $badge)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('icon_image')) {
            $path = $request->file('icon_image')->store('badges', 'public');
            $badge->icon_path = $path;
        }

        $badge->title = $validated['title'];
        $badge->description = $validated['description'];
        $badge->save();

        return redirect()->route($this->route . 'index')->with('success', 'Badge updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Badge $badge)
    {
        $badge->delete();
        return redirect()->route($this->route . 'index')->with('success', 'Badge deleted successfully.');
    }

    /**
     * Show the form to assign a badge to products.
     */
    public function assignForm(Request $request)
    {
        $badges = Badge::all();

        $categories = Category::whereHas('products', function ($query) {
            $query->where('status', true)->whereNull('badge_id');
        })->get();

        $selectedBadgeId = $request->badge_id;
        $selectedCategoryId = $request->category_id;

        $products = collect();

        if ($selectedBadgeId && $selectedCategoryId) {
            $products = Product::where('category_id', $selectedCategoryId)
                ->whereNull('badge_id')
                ->where('status', true)
                ->get();
        }

        return view('badges.assign', compact(
            'badges', 'categories', 'products',
            'selectedBadgeId', 'selectedCategoryId'
        ));
    }

    /**
     * Assign a badge to selected products.
     */
    public function assign(Request $request)
    {
        $request->validate([
            'badge_id' => 'required|exists:badges,id',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        Product::whereIn('id', $request->product_ids)
            ->update(['badge_id' => $request->badge_id]);

        return redirect()->route('products.index')->with('success', 'Badge assigned to selected products.');
    }

}


