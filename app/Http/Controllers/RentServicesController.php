<?php

namespace App\Http\Controllers;

use App\Models\RentService;
use Illuminate\Http\Request;

class RentServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = RentService::all();
        return response()->view('dashboard.rent_service.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        //
        return response()->view('');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'rent_id' => 'required|integer',
            'item_services_id' => 'required|integer',
        ]);
        $storeData = new RentService();
        $storeData->start_date = $request->input('start_date');
        $storeData->end_date = $request->input('end_date');
        $storeData->rents_id = $request->input('rents_id');
        $storeData->item_services_id = $request->input('item_services_id');

        $saved = $storeData->save();
        return redirect()->route('');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $rentServices = RentService::findOrFail($id);
        return response()->view('', ['rentServices' => $rentServices]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $editRentServices = RentService::findOrFail($id);
        return response()->view('', ['editRentServices' => $editRentServices]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'rent_id' => 'required|integer',
            'item_services_id' => 'required|integer',
        ]);

        $updateData = RentService::findOrFail($id);
        $updateData->start_date = $request->input('start_date');
        $updateData->end_date = $request->input('end_date');
        $updateData->rents_id = $request->input('rents_id');
        $updateData->item_services_id = $request->input('item_services_id');

        $saved = $updateData->save();
        return redirect()->route('');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        RentService::destroy($id);
        return redirect()->back();
    }
}
