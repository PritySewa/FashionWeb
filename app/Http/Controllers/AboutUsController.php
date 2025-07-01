<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller

{
    // Display all entries
    public function index()
    {
        $aboutUs = AboutUs::all();
        return view('about_us.index', compact('aboutUs'));
    }

    // Show form to create a new entry
    public function create()
    {
        return view('about_us.create');
    }

    // Store new entry
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'introduction' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'features' => 'required|string|max:255',
            'images' => 'required|string', // or handle file upload if needed
        ]);

        AboutUs::create($request->all());

        return redirect()->route('about-us.index')->with('success', 'About Us entry created successfully.');
    }

    // Show form to edit an existing entry
    public function edit($id)
    {
        $about = AboutUs::findOrFail($id);
        return view('about_us.edit', compact('about'));
    }

    // Update the entry
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'introduction' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'features' => 'required|string|max:255',
            'images' => 'required|string',
        ]);

        $about = AboutUs::findOrFail($id);
        $about->update($request->all());

        return redirect()->route('about-us.index')->with('success', 'About Us entry updated successfully.');
    }

    // Delete an entry
    public function destroy($id)
    {
        $about = AboutUs::findOrFail($id);
        $about->delete();

        return redirect()->route('about-us.index')->with('success', 'About Us entry deleted successfully.');
    }
}

