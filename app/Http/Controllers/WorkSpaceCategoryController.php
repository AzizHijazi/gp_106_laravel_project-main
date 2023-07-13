<?php

namespace App\Http\Controllers;

use App\Models\WorkSpaceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkSpaceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //  

        $data = WorkSpaceCategory::all();
        if ($request->expectsJson()) {
            return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
        }
        return response()->view('dashboard.work_space_categories.index', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'category_name' => 'required|string|min:3|max:25',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'status' => 'nullable|string|in:on',
            ]
        );

        $workSpaceCategory = new WorkSpaceCategory();
        $workSpaceCategory->name = $request->input('category_name');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $workSpaceCategory->image = Storage::url($imagePath);
        }
        $workSpaceCategory->status = $request->has('status');
        $saved = $workSpaceCategory->save();
        return redirect()->route('workspace.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $editData = WorkSpaceCategory::findOrFail($id);

        return response()->view('dashboard.work_space_categories.edit', ['editData' => $editData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_name' => 'required|string|min:3|max:25',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'status' => 'nullable|string|in:on',
        ]);
        $workSpaceCategory = WorkSpaceCategory::findOrFail($id);
        $workSpaceCategory->name = $request->input('category_name');
        $oldImagePath = $workSpaceCategory->image;
        if ($request->hasFile('image')) {
            if ($oldImagePath) {
                Storage::delete($oldImagePath);
            }
            $imagePath = $request->file('image')->store('public/images');
            $workSpaceCategory->image = Storage::url($imagePath);
        }
        $workSpaceCategory->status = $request->has('status');
        $saved = $workSpaceCategory->save();
        return redirect()->route('workspace.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        WorkSpaceCategory::destroy($id);
        return redirect()->back();
    }
}
