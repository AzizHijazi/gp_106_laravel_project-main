<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $meetings = Meeting::where('hub_id', auth()->guard('hub')->id())->with('meetingRoom', 'rent')->get();
        return response()->view('dashboard.meetings.index', ['meetings' => $meetings]);
    }

    public function create()
    {
        //

        return response()->view('dashboard.meetings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //
        $request->validate([
            'duration' => 'required',
            'status' => 'nullable|string|in:on',
        ]);

        $meeting = new Meeting();
        $meeting->duration = $request->input('duration');
        $meeting->status = $request->has('status');
        $saved = $meeting->save();

        return redirect()->route('meetings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $meetings = Meeting::findOrFail($id);
        return response()->view('dashboard.meetings.edit', ['meetings' => $meetings]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'duration' => 'required|numeric',
            'status' => 'nullable|string|in:on',
        ]);

        $meeting = Meeting::findOrFail($id);
        $meeting->duration = $request->input('duration');
        $meeting->status = $request->has('status');
        $saved = $meeting->save();

        return redirect()->route('meetings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Meeting::destroy($id);
        return redirect()->back();
    }
}
