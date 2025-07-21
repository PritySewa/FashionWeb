<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends BaseController
{
    public function __construct()
    {
        $this->title = "About Us";
        $this->resources = "about_us.";
        $this->route = "about_us";
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = $this->crudInfo();
        $info['aboutUs'] = AboutUs::latest()->get();
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
            'name' => 'required|string|max:255',
            'introduction' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'features' => 'required|string|max:255',
            'images' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $path = $request->file('images')->store('about-us', 'public');
        $validated['images'] = $path;

        AboutUs::create($validated);


        return redirect()->route($this->route . 'index')->with('success', 'About Us entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUs $aboutU)
    {
        return view($this->showResource(), compact('aboutU'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUs $aboutU)
    {
        return view($this->editResource(), compact('aboutU'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutUs $aboutU)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'introduction' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'features' => 'required|string|max:255',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->hasFile('images')) {
            $path = $request->file('images')->store('about-us', 'public');
            $validated['images'] = $path;
        }

        $aboutU->update($validated);

        return redirect()->route($this->route . 'index')->with('success', 'About Us entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUs $aboutU)
    {
        $aboutU->delete();

        return redirect()->route($this->route . 'index')->with('success', 'About Us entry deleted successfully.');
    }

    public function view()
    {
        $aboutu = AboutUs::latest()->first();
        return view('AboutUs', compact('aboutu'));
    }

    public function search(Request $request)
    {
        $query = $request->query('query');

        $results = AboutUs::where('name', 'LIKE', "%{$query}%")
            ->orWhere('introduction', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhere('features', 'LIKE', "%{$query}%")
            ->get();

        return view('about_us.searchresult', ['entries' => $results])->render();
    }

}
