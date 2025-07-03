<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends BaseController{
    public function __construct()
    {
        $this->title = "Category";
        $this->resources = "categories.";
        $this->route = "categories";
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = $this->crudInfo(); // Calling method from BaseController
        $info['categories'] = Category::all();
        return view($this->indexResource(),$info);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        return view('badges.create');
        $info = $this->crudInfo();
        return view($this->createResource(),$info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        Category::create($validated);

        return redirect()->route($this->route.'index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view($this->showResource(), compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view($this->editResource(), compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route($this->route.'index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route($this->route .'index')->with('success', 'Category deleted successfully.');
    }
    public function search(Request $request)
    {
        $search = $request->search;

        $categories = Category::where('title', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->get();

        if ($request->ajax()) {
            if ($categories->isEmpty()) {
                return '<tr><td colspan="3" class="text-center text-muted">No categories found.</td></tr>';
            }

            $html = '';
            foreach ($categories as $category) {
                $html .= '
                <tr>
                    <td>' . $category->title . '</td>
                    <td>' . $category->description . '</td>
                    <td>
                        <a href="' . route('categories.edit', $category->id) . '" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a href="' . route('categories.show', $category->id) . '" class="btn btn-sm btn-outline-secondary">Show</a>
                    </td>
                </tr>';
            }

            return response($html);
        }

        return view('categories.index', ['categories' => $categories]);
    }
}
