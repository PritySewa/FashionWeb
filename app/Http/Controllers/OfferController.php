<?php

namespace App\Http\Controllers;

use App\Models\Offers;
use Illuminate\Http\Request;

class OfferController extends BaseController
{
    public function __construct()
    {
        $this->title = 'Offer';
        $this->resources = "offers.";
        $this->route = "offers";
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = $this->crudInfo(); // Calling method from BaseController
        $info['offers'] = Offers::all();
        return view($this->indexResource(),$info);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = $this->crudInfo();
        return view($this->createResource());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'offers' => 'required|string',
        ]);

        Offers::create($validated);

        return redirect()->route($this->route.'index')->with('success', 'Offer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $offers = Offers::findOrFail($id);
        return view($this->showResource(), compact('offers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $offers = Offers::findOrFail($id);
        return view($this->editResource(), compact('offers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'offers' => 'required|string,',
        ]);

        $offers = Offers::findOrFail($id);
        $offers->update($validated);

        return redirect()->route($this->route.'index')->with('success', 'Offers updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $offers = Offers::findOrFail($id);
        $offers->delete();

        return redirect()->route($this->route .'index')->with('success', 'Offers deleted successfully.');
    }
}
