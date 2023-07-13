<?php

namespace App\Http\Controllers;

use App\Models\Hub;
use App\Models\WorkingTime;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;


class WorkingTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $hubId = auth()->guard('hub')->id();
        $data = WorkingTime::where('hub_id', $hubId)->get();

    
        if ($request->expectsJson()) {

            return response()->json(['status' => true, 'message' => 'success', 'data' => $data], Response::HTTP_OK);
        } else {

            return response()->view('dashboard.working_time.index', ['data' => $data]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('dashboard.working_time.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'day' => 'required|string|max:45',
            'status' => 'nullable|string|in:on',
            'interval_type' => [
                'required',
                Rule::in(['daily', 'weekly', 'monthly']),
            ],
            'working_from' => 'required|date|max:45',
            'working_to' => 'required|date|max:45',
        ]);
        $roomStore = new WorkingTime();
        $roomStore->day = $request->input('day');
        $roomStore->interval_type = $request->input('interval_type');
        $roomStore->working_from = $request->input('working_from');
        $roomStore->working_to = $request->input('working_to');
        $hubId = auth()->guard('hub')->id();
        $roomStore->hub_id = $hubId;
        $saved = $roomStore->save();

        return redirect()->route('working_times.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $hubId = auth()->guard('hub')->id();
        $WorkingTimeEdit = WorkingTime::where('hub_id', $hubId)->findOrFail($id);
        return response()->view('dashboard.working_time.edit', ['WorkingTimeEdit' => $WorkingTimeEdit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'day' => 'required|string|max:45',
            'status' => 'nullable|string|in:on',
            'interval_type' => [
                'required',
                Rule::in(['daily', 'weekly', 'monthly']),
            ],
            'working_from' => 'required|string|max:45',
            'working_to' => 'required|string|max:45',
        ]);

        $hubId = auth()->guard('hub')->id();
        $roomUpdate = WorkingTime::where('hub_id', $hubId)->findOrFail($id);
        $roomUpdate->day = $request->input('day');
        $roomUpdate->interval_type = $request->input('interval_type');
        $roomUpdate->working_from = $request->input('working_from');
        $roomUpdate->working_to = $request->input('working_to');
        $roomUpdate->hub_id = $hubId;

        $saved = $roomUpdate->save();

        return redirect()->route('working_times.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $hubId = auth()->guard('hub_id')->id();
        WorkingTime::where('hub_id', $hubId)->findOrFail($id)->delete();
        return redirect()->back();
    }
}
