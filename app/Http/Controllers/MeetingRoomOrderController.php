<?php

namespace App\Http\Controllers;

use App\Models\MeetingRoom;
use App\Models\MeetingRoomOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MeetingRoomOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TO DO Meeting Room Order Controller
        $meetingRoomOrders = MeetingRoomOrder::where('hub_id', auth()->guard('hub')->id())->with('meeting_room')->with('user')->get();
        
        return response()->view('dashboard.meetings_rooms_orders.index', ['meetingRoomOrders' => $meetingRoomOrders]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::all();
        $meeting_rooms = MeetingRoom::where('hub_id', auth()->guard('hub')->id())->get();
        return  response()->view('dashboard.meetings_rooms_orders.create', ['users' => $users, 'meeting_rooms' => $meeting_rooms]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'check_in_date' => 'required|date',
            'check_in_time' => 'required',
            'check_out_time' => 'required|after:check_in_time',
            'category' => 'required|string|max:100',
            'seats' => 'required|integer',
            'guest_count' => 'required|integer',
            'duration' => 'required|integer',
            'meeting_room_id' => 'required|integer|exists:meeting_rooms,id',
            'user_id' => 'required|integer|exists:users,id',
            'status' => 'nullable|string|in:pending,confirmed,canceled',
        ]);

        $meetingRoomId = $request->input('meeting_room_id');
        $meetingRoom = MeetingRoom::where('hub_id', auth()->guard('hub')->id())->findOrFail($meetingRoomId);
        // Calculate the start and end timestamps of the booking
        $startTimestamp = strtotime($request->input('check_in_date') . ' ' . $request->input('check_in_time'));
        $endTimestamp = strtotime($request->input('check_in_date') . ' ' . $request->input('check_out_time'));
        // Calculate the duration in hours
        $durationInHours = ($endTimestamp - $startTimestamp) / (60 * 60);
        // Calculate the total price
        $totalPrice = $durationInHours * $meetingRoom->hour_price;
        $store = new MeetingRoomOrder();
        $store->day = $request->input('check_in_date');
        $store->start_date = Carbon::parse($request->input('check_in_date') . ' ' . $request->input('check_in_time'));
        $store->end_date = Carbon::parse($request->input('check_in_date') . ' ' . $request->input('check_out_time'));
        $store->category = $request->input('category');
        $store->guest_count = $request->input('guest_count');
        $store->duration = $request->input('duration');
        $store->meeting_room_id = $meetingRoom->id;
        $store->total = $totalPrice; // Set the calculated total price
        $store->hub_id = auth()->guard('hub')->id();
        $store->user_id = 1;
        $saved = $store->save();
        if ($request->expectsJson()) {
            return response()->json(['status' => $saved, 'message' => $saved ? 'Ordered Meeting Room Successfully' : 'Ordered Failed Try Again'], $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }

        return redirect()->route('meeting_room_orders.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $meeting_room_order = MeetingRoomOrder::where('hub_id', auth()->guard('hub')->id())
            ->findOrFail($id);

        $meeting_rooms = MeetingRoom::where('hub_id', auth()->guard('hub')->id())->get();
        $users = User::all();

        return view('dashboard.meetings_rooms_orders.edit', compact('meeting_room_order', 'meeting_rooms', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'check_in_date' => 'required|date',
            'check_in_time' => 'required',
            'check_out_time' => 'required|after:check_in_time',
            'category' => 'required|string|max:100',
            'seats' => 'required|integer',
            'guest_count' => 'required|integer',
            'duration' => 'required|integer',
            'meeting_room_id' => 'required|integer|exists:meeting_rooms,id',
            'user_id' => 'required|integer|exists:users,id',
            'status' => 'nullable|string|in:pending,confirmed,canceled',
        ]);
        $meetingRoomId = $request->input('meeting_room_id');
        $meetingRoom = MeetingRoom::where('hub_id', auth()->guard('hub')->id())->findOrFail($meetingRoomId);
        // Calculate the start and end timestamps of the booking
        $startTimestamp = strtotime($request->input('check_in_date') . ' ' . $request->input('check_in_time'));
        $endTimestamp = strtotime($request->input('check_in_date') . ' ' . $request->input('check_out_time'));
        // Calculate the duration in hours
        $durationInHours = ($endTimestamp - $startTimestamp) / (60 * 60);
        // Calculate the total price
        $totalPrice = $durationInHours * $meetingRoom->hour_price;
        $store = MeetingRoomOrder::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);
        $store->day = $request->input('check_in_date');
        $store->start_date = Carbon::parse($request->input('check_in_date') . ' ' . $request->input('check_in_time'));
        $store->end_date = Carbon::parse($request->input('check_in_date') . ' ' . $request->input('check_out_time'));
        $store->category = $request->input('category');
        $store->guest_count = $request->input('guest_count');
        $store->duration = $request->input('duration');
        $store->meeting_room_id = $meetingRoom->id;
        $store->total = $totalPrice; // Set the calculated total price
        $store->hub_id = auth()->guard('hub')->id();
        $store->user_id = 1;
        $saved = $store->save();

        return redirect()->route('meeting_room_orders.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = MeetingRoomOrder::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);
        $deleted = $destroy->delete();  
        return redirect()->back();
    }
}
