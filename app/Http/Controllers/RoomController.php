<?php

namespace App\Http\Controllers;

use App\Models\Hub;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $hubId = auth()->guard('hub')->id();
        $rooms = Room::where('hub_id', $hubId)->get();
        
        if ($request->expectsJson()) {

            return response()->json(['status' => true, 'message' => 'success', 'data' => $rooms], Response::HTTP_OK);
        } else {

            return response()->view('dashboard.rooms.index', ['rooms' => $rooms]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('dashboard.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'room_number' => 'required|string',
            'name' => 'required|string|max:45',
            'description' => 'required|string|min:15,max:300',
            'size' => 'required|integer',
            'status' => 'nullable|string|in:on',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $hubId = auth()->guard('hub')->id();
        $room = new Room();
        $room->room_number = $request->input('room_number');
        $room->name = $request->input('name');
        $room->size = $request->input('size');
        $room->description = $request->input('description');
        $room->status = $request->has('status');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $room->image = Storage::url($imagePath);
        }
        $room->price = $request->input('price');
        $room->hub_id = $hubId;
        $saved = $room->save();
        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $hubId = auth()->guard('hub')->id();

        $room = Room::where('hub_id', $hubId)->findOrFail($id);
        return response()->view('dashboard.rooms.show', ['rooms' => $room]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $hubId = auth()->guard('hub')->id();

        $room = Room::where('hub_id', $hubId)->findOrFail($id);
        return response()->view('dashboard.rooms.edit', ['rooms' => $room]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'room_number' => 'required|string',
            'name' => 'required|string|max:45',
            'description' => 'required|string|min:15,max:300',
            'size' => 'required|integer',
            'status' => 'nullable|string|in:on',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $hubId = auth()->guard('hub')->id();
        $roomUpdate = Room::where('hub_id', $hubId)->findOrFail($id);
        $roomUpdate->name = $request->input('name');
        $roomUpdate->description = $request->input('description');
        $roomUpdate->size = $request->input('size');
        $image = $request->file('image');
        $oldImagePath = $roomUpdate->image;
        if ($request->hasFile('image')) {
            if ($oldImagePath) {
                Storage::delete($oldImagePath);
            }
            $imagePath = $request->file('image')->store('public/images');
            $roomUpdate->image = Storage::url($imagePath);
        }
        $roomUpdate->status = $request->has('status');
        $roomUpdate->price = $request->input('price');
        $roomUpdate->hub_id = $hubId;
        $saved = $roomUpdate->save();
        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = Room::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);

        if (Storage::disk('public')->exists($room->image)) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        return redirect()->back();
    }
}
