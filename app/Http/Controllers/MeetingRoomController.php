<?php

namespace App\Http\Controllers;

use App\Models\MeetingRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class MeetingRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $hubId = auth()->guard('hub')->id();
        $meetingRooms = MeetingRoom::where('hub_id', $hubId)->get();

        if ($request->expectsJson()) {

            return response()->json(['status' => true, 'message' => 'success', 'data' => $meetingRooms], Response::HTTP_OK);
        } else {

            return response()->view('dashboard.meeting_rooms.index', ['meetingRooms' => $meetingRooms]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return response()->view('dashboard.meeting_rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|min:5',
            'seats' => 'required|integer',
            'info' => 'required|string|max:350',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'status' => 'nullable|string|in:on',
        ]);

        $meetingRoom = new MeetingRoom();
        $meetingRoom->name = $request->input('name');
        $meetingRoom->size = $request->input('seats');
        $meetingRoom->info = $request->input('info');
        $meetingRoom->hour_price = $request->input('price');
        $meetingRoom->duration = $request->input('duration');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $meetingRoom->image = Storage::url($imagePath);
        }
        $meetingRoom->status = $request->has('status');
        $meetingRoom->hub_id = auth()->guard('hub')->id();
        $saved = $meetingRoom->save();
        return redirect()->route('meeting_rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $meetingRooms = MeetingRoom::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);
        return response()->view('dashboard.meeting_rooms.show', ['meetingRooms' => $meetingRooms]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $meetingRooms = MeetingRoom::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);

        return response()->view('dashboard.meeting_rooms.edit', ['meetingRooms' => $meetingRooms]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|min:5',
            'seats' => 'required|integer',
            'info' => 'required|string|max:350',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'status' => 'nullable|string|in:on',
        ]);

        $meetingRoomUpdate = MeetingRoom::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);
        $meetingRoomUpdate->name = $request->input('name');
        $meetingRoomUpdate->size = $request->input('seats');
        $meetingRoomUpdate->info = $request->input('info');
        $meetingRoomUpdate->hour_price = $request->input('price');
        $meetingRoomUpdate->duration = $request->input('duration');
        $oldImagePath = $meetingRoomUpdate->image;
        if ($request->hasFile('image')) {
            if ($oldImagePath) {
                Storage::delete($oldImagePath);
            }
            $imagePath = $request->file('image')->store('public/images');
            $meetingRoomUpdate->image = Storage::url($imagePath);
        }
        $meetingRoomUpdate->status = $request->has('status');
        $meetingRoomUpdate->hub_id = auth()->guard('hub')->id();
        $saved = $meetingRoomUpdate->save();
        return redirect()->route('meeting_rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        MeetingRoom::where('hub_id', auth()->guard('hub')->id())->findOrFail($id)->delete();
        return redirect()->back();
    }
}
