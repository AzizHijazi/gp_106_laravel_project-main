<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $data = City::all();

        if ($request->expectsJson()) {

            return response()->json(['status' => true, 'message' => 'success', 'data' => $data], Response::HTTP_OK);
        } else {

            return response()->view('dashboard.cites.index', ['data' => $data]);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'city' => 'required|string|max:45',
            'status' => 'nullable|string|in:on',
        ]);

        $storeData = new City();
        $storeData->name = $request->input('city');
        $storeData->status = $request->has('status');
        $saved = $storeData->save();
        return redirect()->route('cities.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $editData = City::findOrFail($id);
        return response()->view('dashboard.cites.edit', ['editData' => $editData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'city' => 'required|string|max:45',
            'status' => 'nullable|string|in:on',
        ]);

        $updateData = City::findOrFail($id);
        $updateData->name = $request->input('city');
        $updateData->status = $request->has('status');
        $saved = $updateData->save();
        return redirect()->route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        City::destroy($id);
        return redirect()->back();
    }
}
