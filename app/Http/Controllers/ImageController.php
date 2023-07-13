<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Image::where('hub_id', auth()->guard('hub')->id())->with('gallerys')->get();
        return response()->view('dashboard.image.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $create = Gallery::where('hub_id', auth()->guard('hub')->id())->get();
        return response()->view('dashboard.image.image_create', ['create' => $create]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'gallery_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $storeData = new Image();
        $storeData->gallery_id = $request->input('gallery_id');
        $storeData->hub_id  = auth()->guard('hub')->id();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $storeData->image = Storage::url($imagePath);
        }
        $saved = $storeData->save();
        return redirect()->route('image.index');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Image::where('hub_id', auth()->guard('hub')->id())->findOrFail($id)->delete();
        return redirect()->back();
    }
}
