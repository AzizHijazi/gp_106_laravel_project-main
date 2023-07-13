<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Gallery::where('hub_id', auth()->guard('hub')->id())->with('hub')->get();
        return response()->view('dashboard.gallery.index', ['data' => $data]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:45',
        ]);

        $storeData = new Gallery();
        $storeData->name = $request->input('name');
        $storeData->hub_id  = auth()->guard('hub')->id();
        $saved = $storeData->save();
        return redirect()->route('gallery.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $editData = Gallery::findOrFail($id);
        return response()->view('dashboard.gallery.edit', ['editData' => $editData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:45',
        ]);

        $storeData = Gallery::findOrFail($id);
        $storeData->name = $request->input('name');
        $storeData->hub_id  = auth()->guard('hub')->id();
        $saved = $storeData->save();
        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Gallery::where('hub_id', auth()->guard('hub')->id())->findOrFail($id)->delete();
        return redirect()->back();
    }
}
