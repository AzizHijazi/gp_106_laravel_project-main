<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Models\DeskType;
use App\Models\Hub;
use App\Models\MeetingRoom;
use App\Models\Room;
use Illuminate\Http\Request;
use Dotenv\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class HubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $hubs = Hub::all();
        $hubCount = count($hubs); // Get the count of hubs

        if ($request->expectsJson()) {
            return response()->json(['status' => true, 'message' => 'success', 'data' => $hubs, 'count' => $hubCount], Response::HTTP_OK);
        } else {
            return response()->view('dashboard.hubs.hub_index', ['hubs' => $hubs]);
        }
    }


    public function roomsBelongsToHub(Request $request, string $id)
    {
        $roomsBelongsToHub = Hub::findOrFail($id)->with('rooms')->withCount('rooms')->first();
        return response()->json(['status' =>  true, 'message' => 'success', 'data' => $roomsBelongsToHub], Response::HTTP_OK);
    }

    public function allIndex()
    {
        $rooms = Room::all();
        $desks = Desk::all();
        $meetingRooms = MeetingRoom::all();

        $deskCount = $desks->count();
        $roomCount = $rooms->count();
        $meetingRoomCount = $meetingRooms->count();
        $total = $deskCount + $roomCount + $meetingRoomCount;
        $desks->each(function ($desk) {
            $desk->size = $desk->desktype->size;
        });

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => compact('rooms', 'desks', 'meetingRooms', 'total')
        ]);
    }




    public function allForHub(Request $request, string $id)
    {
        $rooms = Room::where('hub_id', $id)->get();
        $desks = Desk::where('hub_id', $id)->get();
        $desks->each(function ($desk) {
            $desk->size = $desk->desktype->size;
        });

        $meetingRooms = MeetingRoom::where('hub_id', $id)->get();
        return response()->json(['status' => true, 'message' => 'success', 'data' => compact('rooms', 'desks', 'meetingRooms')]);
    }

    public function deskBelongsToHub(Request $request, string $id)
    {
        $deskBelongsToHub = Hub::findOrFail($id)->with('desks')->withCount('desks')->first();
        return response()->json(['status' => true, 'message' => 'success', 'data' => $deskBelongsToHub], Response::HTTP_OK);
    }


    public function workingTimesForTheHub(Request $request)
    {
        $workingTimesForTheHub = Hub::with('workkingTimes')->get();
        return response()->json(['status' => true, 'message' => 'success', 'data' => $workingTimesForTheHub], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.hubs.hub_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|min:5|max:100',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'location' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:10',
            'mobile' => 'required|string|min:8',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'cover_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'interval_type' => [
                'required',
                Rule::in(['daily', 'weekly', 'monthly']),
            ],
        ]);
        $hub = new Hub();
        $hub->name = $request->input('name');
        $hub->email = $request->input('email');
        $hub->password = Hash::make($request->input('password'));
        $hub->location = $request->input('location');
        $hub->description = $request->input('description');
        $hub->mobile = $request->input('mobile');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $hub->image = Storage::url($imagePath);
        }
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('public/images');
            $hub->cover_image = Storage::url($imagePath);
        }
        $hub->interval_type = $request->input('interval_type');
        $saved = $hub->save();
        return redirect()->route('hubs.index')->with('success', 'Success! Hub Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        //
        $hub = Hub::findOrFail($id);
        if ($request->expectsJson()) {
            return response()->json(['status' => !is_null($hub), 'message' => $hub ? 'Success' : 'Not Found', 'object' => $hub]);
        }
        return response()->view('dashboard.hubs.show', ['hub' => $hub]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $hub = Hub::findOrFail($id);
        return response()->view('dashboard.hubs.hub_edit', ['hubs' => $hub]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|min:5|max:100',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'location' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:10',
            'mobile' => 'required|string|min:8',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'cover_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'interval_type' => [
                'required',
                Rule::in(['daily', 'weekly', 'monthly']),
            ],
        ]);
        $hubs = Hub::findOrFail($id);
        $hubs->name = $request->input('name');
        $hubs->email = $request->input('email');
        $hubs->password = Hash::make($request->input('password'));
        $hubs->location = $request->input('location');
        $hubs->description = $request->input('description');
        $hubs->mobile = $request->input('mobile');
        $oldImagePath = $hubs->image;
        $oldCoverImagePath = $hubs->cover_image;
        if ($request->hasFile('image')) {
            if ($oldImagePath) {
                Storage::delete($oldImagePath);
            }
            $imagePath = $request->file('image')->store('public/images');
            $hubs->image = Storage::url($imagePath);
        }
        if ($request->hasFile('cover_image')) {
            if ($oldCoverImagePath) {
                Storage::delete($oldImagePath);
            }
            $imagePath = $request->file('cover_image')->store('public/images');
            $hubs->cover_image = Storage::url($imagePath);
        }

        $hubs->interval_type = $request->input('interval_type');
        $saved = $hubs->save();
        return redirect()->route('hubs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //  
        Hub::destroy($id);
        return redirect()->back();
    }
}
