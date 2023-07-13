<?php

namespace App\Http\Controllers;

use App\Models\DeskType;
use Illuminate\Http\Request;

class DeskTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hubId = auth()->guard('hub')->id();
        $deskType = DeskType::where('hub_id', $hubId)->get();
        return response()->view('dashboard.desk_type.index', ['deskTypes' => $deskType]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:45',
            'info' => 'required|string|max:45',
            'count' => 'required|integer',
        ]);
        $store = new DeskType();
        $store->name = $request->input('name');
        $store->info = $request->input('info');
        $store->size = $request->input('count');
        $hubId = auth()->guard('hub')->id();
        $store->hub_id = $hubId;
        $saved = $store->save();
        return redirect()->route('desk_types.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $hubId = auth()->guard('hub')->id();
        $edit = DeskType::where('hub_id', $hubId)->findOrFail($id);
        return response()->view('dashboard.desk_type.edit', ['edit' => $edit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:45',
            'info' => 'required|string|max:45',
            'count' => 'required|integer',
        ]);
        $hubId = auth()->guard('hub')->id();
        $update = DeskType::where('hub_id', $hubId)->findOrFail($id);
        $update->name = $request->input('name');
        $update->info = $request->input('info');
        $update->size = $request->input('count');
        $update->hub_id = $hubId;
        $saved = $update->save();
        return redirect()->route('desk_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DeskType::where('hub_id', auth()->guard('hub')->id())->findOrFail($id)->delete();
        return redirect()->back();
    }
}
