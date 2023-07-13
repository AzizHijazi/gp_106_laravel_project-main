<?php

namespace App\Http\Controllers;

use App\Models\Hub;
use App\Models\ItemService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = ItemService::with('hub', 'service')->get();
        return response()->view('dashboard.item_service.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $itemServiceHubCreate = Hub::all();
        $itemServiceCreate = Service::all();
        return response()->view('dashboard.item_service.create', ['itemServiceCreate' => $itemServiceCreate, 'itemServiceHubCreate' => $itemServiceHubCreate]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'info' => 'required|string|max:45',
            'count' => 'required|integer',
            'hub_id' => 'required|exists:hubs,id',
            'service_id' => 'required|exists:services,id',
            'item_type' => [
                'required',
                Rule::in(['primary', 'additona']),
            ],
            'cost' => 'required|integer',
        ]);
        $itemServiceStore = new ItemService();
        $itemServiceStore->info = $request->input('info');
        $itemServiceStore->count = $request->input('count');
        $itemServiceStore->hub_id = $request->input('hub_id');
        $itemServiceStore->service_id = $request->input('service_id');
        $itemServiceStore->item_type = $request->input('item_type');
        $itemServiceStore->cost = $request->input('cost');
        $saved = $itemServiceStore->save();
        return redirect()->route('item_services.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $itemServiceEdit = ItemService::findOrFail($id);
        $itemServiceHub = Hub::all();
        $itemService = Service::all();
        return response()->view('dashboard.item_service.edit', ['itemServiceEdit' => $itemServiceEdit, 'itemServiceHub' => $itemServiceHub, 'itemService' => $itemService]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'info' => 'required|string|max:45',
            'count' => 'required|integer',
            'hub_id' => 'required|exists:hubs,id',
            'service_id' => 'required|exists:services,id',
            'item_type' => [
                'required',
                Rule::in(['primary', 'additona']),
            ],
            'cost' => 'required|integer',
        ]);
        $itemServiceStore = ItemService::findOrFail($id);
        $itemServiceStore->info = $request->input('info');
        $itemServiceStore->count = $request->input('count');
        $itemServiceStore->hub_id = $request->input('hub_id');
        $itemServiceStore->service_id = $request->input('service_id');
        $itemServiceStore->item_type = $request->input('item_type');
        $itemServiceStore->cost = $request->input('cost');
        $saved = $itemServiceStore->save();

        return redirect()->route('item_services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        ItemService::destroy($id);
        return redirect()->back();
    }
}
