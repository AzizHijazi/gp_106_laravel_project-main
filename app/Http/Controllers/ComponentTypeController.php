<?php

namespace App\Http\Controllers;

use App\Models\ComponentType;
use App\Models\Hub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComponentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $components = ComponentType::with('hub')->get();
        return response()->view('dashboard.component_types.index', ['components' => $components]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $hub = Hub::all();
        return response()->view('dashboard.component_types.create', ['hubs' => $hub]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:145',
            'description' => 'required|string|min:3',
            'count' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'hub_id' => 'required|exists:hubs,id',
        ]);

        $component = new ComponentType();
        $component->name = $request->input('name');
        $component->description = $request->input('description');
        $component->count = $request->input('count');
        $component->price = $request->input('price');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $component->image = Storage::url($imagePath);
        }
        $component->hub_id = $request->input('hub_id');
        $saved = $component->save();

        return redirect()->route('component_types.store');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //

        $componentType = ComponentType::with('hub')->findOrFail($id);
        return response()->view('dashboard.component_types.show', ['component_types' => $componentType]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $componentType = ComponentType::findOrFail($id);
        $hubs = Hub::all();
        return response()->view('dashboard.component_types.edit', ['componentTypes' => $componentType, 'hubs' => $hubs]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //
        $request->validate([
            'name' => 'required|string|max:145',
            'description' => 'required|string|min:3',
            'count' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'hub_id' => 'required|exists:hubs,id',
        ]);

        $component = ComponentType::findOrFail($id);
        $component->name = $request->input('name');
        $component->description = $request->input('description');
        $component->count = $request->input('count');
        $component->price = $request->input('price');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $component->image = Storage::url($imagePath);
        }
        $component->hub_id = $request->input('hub_id');
        $saved = $component->save();

        return redirect()->route('component_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        ComponentType::destroy($id);
        return redirect()->back();
    }
}
