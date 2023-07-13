<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Desk;
use App\Models\ItemComponent;
use App\Models\MeetingRoom;
use App\Models\Room;
use Illuminate\Http\Request;

class ItemComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($type)
    {
        //
        if (in_array($type, ['room', 'desk', 'meeting_room'])) {
            $itemComponent = ItemComponent::with('item');
            if ($type == 'room') {
                $itemComponent->whereHasMorph('item', [Room::class]);
            } elseif ($type == 'desk') {
                $itemComponent->whereHasMorph('item', [Desk::class]);
            } elseif ($type == 'meeting_room') {
                $itemComponent->whereHasMorph('item', [MeetingRoom::class]);
            }
            $itemComponents = $itemComponent->get();

            return view('dashboard.item_components.index', [
                'itemComponents' => $itemComponents,
                'type' => $type,
            ]);
        }

        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $component = Component::all();

        return response()->view('dashboard.item_components.create' . ['components' => $component]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'item_id' => 'required|integer',
            'item_type' => 'required|string|max:255',
            'component_id' => 'required|exists:components,id',
        ]);
        $itemComponents = new ItemComponent();
        $itemComponents->item_id = $request->input('item_id');
        $itemComponents->item_type = $request->input('item_type');
        $itemComponents->component_id = $request->input('component_id');
        if ($request->input('item_type') === 'desk') {
            $desk = Desk::findOrFail($request->input('item_id'));
            $desk->itemComponents()->save($itemComponents);
        } else if ($request->input('item_type') === 'room') {
            $room = Room::findOrFail($request->input('item_id'));
            $room->itemComponents()->save($itemComponents);
        } else if ($request->input('item_type') === 'meeting_room') {
            $meetingRoom = MeetingRoom::findOrFail($request->input('item_id'));
            $meetingRoom->itemComponents()->save($itemComponents);
        }
        return redirect()->route('item_components.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($type, string $id)
    {
        //

        if (in_array($type, ['room', 'desk', 'meeting_room'])) {
            $itemComponent = ItemComponent::with('item');
            if ($type == 'room') {
                $itemComponent->whereHasMorph('item', [Room::class]);
            } elseif ($type == 'desk') {
                $itemComponent->whereHasMorph('item', [Desk::class]);
            } elseif ($type == 'meeting_room') {
                $itemComponent->whereHasMorph('item', [MeetingRoom::class]);
            }
            $itemComponents = $itemComponent->findOrFail($id);

            return view('dashboard.item_components.edit', [
                'itemComponents' => $itemComponents,
                'type' => $type,
            ]);
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'item_id' => 'required|integer',
            'item_type' => 'required|string|max:255',
            'component_id' => 'required|exists:components,id',
        ]);
        $itemComponents =  ItemComponent::findOrFail($id);
        $itemComponents->item_id = $request->input('item_id');
        $itemComponents->item_type = $request->input('item_type');
        $itemComponents->component_id = $request->input('component_id');
        if ($request->input('item_type') === 'desk') {
            $desk = Desk::findOrFail($request->input('item_id'));
            $desk->itemComponents()->save($itemComponents);
        } else if ($request->input('item_type') === 'room') {
            $room = Room::findOrFail($request->input('item_id'));
            $room->itemComponents()->save($itemComponents);
        } else if ($request->input('item_type') === 'meeting_room') {
            $meetingRoom = MeetingRoom::findOrFail($request->input('item_id'));
            $meetingRoom->itemComponents()->save($itemComponents);
        }
        return redirect()->route('');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        ItemComponent::destroy($id);
        return redirect()->back();
    }
}
