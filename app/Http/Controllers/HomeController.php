<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;



class HomeController extends BaseController
{
    public function __construct()
    {
        $this->title = "HomeDesign";
        $this->resources = "home_design.";
        $this->route = "home_design";
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = $this->crudInfo();
        $info['homes'] = Home::latest()->get();
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
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'required|string',
            'phone_no' => 'required|string|max:20',
            'address' => 'required|string',
            'email' => 'required|email',
        ]);

        $path = $request->file('image')->store('homes', 'public');
        $validated['image'] = $path;

        Home::create($validated);

        return redirect()->route($this->route . 'index')->with('success', 'Home design created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $home = Home::findOrFail($id);
        return view($this->showResource(), compact('home'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $home = Home::findOrFail($id);
        return view($this->editResource(), compact('home'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $home = Home::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'required|string',
            'phone_no' => 'required|string|max:20',
            'address' => 'required|string',
            'email' => 'required|email',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('homes', 'public');
            $validated['image'] = $path;
        }

        $home->update($validated);

        return redirect()->route($this->route . 'index')->with('success', 'Home design updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $home = Home::findOrFail($id);
        $home->delete();

        return redirect()->route($this->route . 'index')->with('success', 'Home design deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->get('query'); // match this with the frontend key!

        $results = Home::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return view('home_design.searchresult', ['homes' => $results])->render();
    }
}
