<?php

namespace App\Http\Controllers;

use App\Models\RentType;
use Illuminate\Http\Request;

class RentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $hubId = auth()->guard('hub')->id();
        $data = RentType::where('hub_id', $hubId)->get();
        return response()->view('dashboard.rent_type.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:45',
            'status' => 'nullable|string|in:on',
        ]);
        //  dd($request->all());
        $hubId = auth()->guard('hub')->id();
        $store = new RentType();
        $store->name = $request->input('name');
        $store->status = $request->has('status');
        $store->hub_id = $hubId;
        $saved = $store->save();
        return redirect()->route('rent_types.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $hubId = auth()->guard('hub')->id();
        $edit = RentType::where('hub_id', $hubId)->findOrFail($id);
        return response()->view('dashboard.rent_type.edit', ['edit' => $edit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:45',
            'status' => 'nullable|string|in:on',
        ]);

        $hubId = auth()->guard('hub')->id();
        $update = RentType::where('hub_id', $hubId)->findOrFail($id);
        $update->name = $request->input('name');
        $update->status = $request->has('status');
        $update->hub_id = $hubId;
        $saved = $update->save();
        return redirect()->route('rentType.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        RentType::where('hub_id', auth()->guard('hub')->id())->findOrFail($id)->delete();
        return redirect()->back();
    }
}
