<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Models\DeskType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DeskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $data = Desk::where('hub_id', auth()->guard('hub')->id())->with('desktype')->get();
        
        if ($request->expectsJson()) {

            return response()->json(['status' => true, 'message' => 'success', 'data' => $data], Response::HTTP_OK);
        } else {

            return response()->view('dashboard.desks.index', ['data' => $data]);
        }

    }

    public function deskTypeForDesk(Request $request){

        $dataDeskType = Desk::with('desktype')->withCount('desktype')->get();
        return response()->json(['status'=>true,'message'=>'success','data'=>$dataDeskType], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = DeskType::where('hub_id', auth()->guard('hub')->id())->get();
        return response()->view('dashboard.desks.create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'desk_code' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string|min:15,max:300',
            'status' => 'nullable|string|in:on',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'desk_type_id' => 'required|exists:desk_types,id',
        ]);

        $storeData = new Desk();
        $storeData->name = $request->input('name');
        $storeData->desk_code = $request->input('desk_code');
        $storeData->price = $request->input('price');
        $storeData->description = $request->input('description');
        $storeData->status = $request->has('status');
        $storeData->desk_type_id = $request->input('desk_type_id');
        $storeData->hub_id = auth()->guard('hub')->id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $storeData->image = Storage::url($imagePath);
        }

        $saved = $storeData->save();
        return redirect()->route('desks.store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $desks = Desk::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);
        return response()->view('dashboard.desks.show', ['desks' => $desks]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //        
        $editData = Desk::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);
        $desk_type = DeskType::where('hub_id', auth()->guard('hub')->id())->get();
        return response()->view('dashboard.desks.edit', ['editData' => $editData, 'desk_type' => $desk_type]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'desk_code' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string|min:15,max:300',
            'status' => 'nullable|string|in:on',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'desk_type_id' => 'required|exists:desk_types,id',
        ]);
        $hubId = auth()->guard('hub')->id();
        $updateData = Desk::where('hub_id', $hubId)->findOrFail($id);
        $updateData->name = $request->input('name');
        $updateData->desk_code = $request->input('desk_code');
        $updateData->price = $request->input('price');
        $updateData->description = $request->input('description');
        $updateData->status = $request->has('status');
        $updateData->desk_type_id = $request->input('desk_type_id');
        $updateData->hub_id = $hubId;
        $oldImagePath = $updateData->image;
        if ($request->hasFile('image')) {
            if ($oldImagePath) {
                Storage::delete($oldImagePath);
            }
            $imagePath = $request->file('image')->store('public/images');
            $updateData->image = Storage::url($imagePath);
        }
        $saved = $updateData->save();
        return redirect()->route('desks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $desk = Desk::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);
        Storage::delete($desk->image);
        $deleted = $desk->delete();
        return redirect()->back();
    }
}
