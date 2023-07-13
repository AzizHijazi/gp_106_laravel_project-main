<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\ComponentType;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $components = Component::with('componentType')->get();
        return response()->view('dashboard.component.index', ['components' => $components]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $components = ComponentType::all();
        return response()->view('dashboard.component.create', ['components' => $components]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'condition' => 'nullable|string|in:on',
            'code' => 'required|integer',
            'notes' => 'required|string',
            'component_type_id' => 'required|exists:component_types,id',
        ]);

        $component = new Component();
        $component->condition = $request->has('condition');
        $component->code = $request->input('code');
        $component->notes = $request->input('notes');
        $component->component_type_id = $request->input('component_type_id');
        $saved = $component->save();

        return redirect()->route('components.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $component = Component::findOrFail($id);
        $component_types = ComponentType::all();
        return response()->view('dashboard.component.edit', ['components' => $component, 'component_types' => $component_types]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'condition' => 'nullable|string|in:on',
            'code' => 'required|integer',
            'notes' => 'required|string',
            'component_type_id' => 'required|exists:component_types,id',
        ]);

        $component = Component::findOrFail($id);
        $component->condition = $request->has('condition');
        $component->code = $request->input('code');
        $component->notes = $request->input('notes');
        $component->component_type_id = $request->input('component_type_id');
        $saved = $component->save();

        return redirect()->route('components.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Component::destroy($id);
        return redirect()->back();
    }
}
