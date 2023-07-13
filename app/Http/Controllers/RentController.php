<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Models\DeskType;
use App\Models\Hub;
use App\Models\MeetingRoom;
use App\Models\MeetingRoomOrder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Rent;
use App\Models\RentType;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $type)
    {
        if (in_array($type, ['room', 'desk', 'meeting_rooms'])) {
            $rents = OrderItem::with('item');
            if ($type == 'room') {
                $rents->whereHasMorph('item', [Room::class]);
            } elseif ($type == 'desk') {
                $rents->whereHasMorph('item', [Desk::class]);
            } elseif ($type == 'meeting_rooms') {
                $rents->whereHasMorph('item', [MeetingRoom::class]);
            }
            $rents = $rents->where('hub_id', auth()->guard('hub')->id())->get();
            return view('dashboard.rent.index', [
                'rents' => $rents,
                'type' => $type,

            ]);
        }
        abort(404);
    }



    public function myRent(Request $request)
    {
        $request->validate([
            'type' => 'nullable|in:confirmed',
        ]);

        $rents = Rent::where('user_id', Auth::user()->id)
            ->where('status', $request->type)
            ->get();

        $count = $rents->count();

        foreach ($rents as $rent) {
            if ($rent->item_type === 'App\Models\Desk') {
                $desk = DeskType::find($rent->item->desk_type_id);
                $rent->item->size = $desk->count;
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'Successfully',
            'count' => $count,
            'data' => $rents,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $room = Room::where('hub_id', auth()->guard('hub')->id())->get();
        $desk = Desk::where('hub_id', auth()->guard('hub')->id())->get();
        $meetingRooms = MeetingRoom::where('hub_id', auth()->guard('hub')->id())->get();
        $users = User::all();
        $orderItems = OrderItem::where('hub_id', auth()->guard('hub')->id())->get();
        $rentTypes = RentType::where('hub_id', auth()->guard('hub')->id())->get();
        return view('dashboard.rent.create', ['rooms' => $room, 'desks' => $desk, 'meeting_rooms' => $meetingRooms, 'users' => $users, 'orders' => $orderItems, 'rentTypes' => $rentTypes]);
    }




    /**
     * Store a newly created resource in storage.
     */


    public function storeConfirm(Request $request)
    {
        $orderItem = $request->input('id');

        // Determine the type of the order
        $orderType = $request->input('type_name');

        // Find the corresponding order based on the type
        $order = null;
        if ($orderType === 'meeting_rooms') {
            $order = MeetingRoomOrder::where('hub_id', auth()->guard('hub')->id())->with('meeting_room')->findOrFail($orderItem);
        } else {
            $order = OrderItem::where('hub_id', auth()->guard('hub')->id())->findOrFail($orderItem);
        }

        $order->status = 'confirmed';
        $order->save();
        // Create a rent based on the order type
        if ($orderType === 'meeting_rooms') {
            $orderItem = new OrderItem();
            $orderItem->start_date = $order->start_date;
            $orderItem->end_date = $order->end_date;
            $orderItem->status = 'confirmed';
            $orderItem->item_id = $order->item_id;
            $orderItem->item_type = 'App\Models\MeetingRoom';
            $orderItem->price = $order->price;
            $orderItem->details = $order->details;
            $orderItem->hub_id = $order->hub_id;
        } else {
            $orderItem = new OrderItem();
            $orderItem->start_date = $order->start_date;
            $orderItem->end_date = $order->end_date;
            $orderItem->status = 'confirmed';
            $orderItem->item_id = $order->item_id;
            $orderItem->item_type = $order->item_type;
            $orderItem->price = $order->price;
            $orderItem->details = $order->details;
            $orderItem->hub_id = $order->hub_id;
        }

        return redirect()->route('order_items.index', ['    type_name' => $orderType])->with('success', 'Rent created successfully.');
    }



    public function storeCanceled(Request $request)
    {
        //
        $orderItem = $request->input('id');
        $order = OrderItem::where('hub_id', auth()->guard('hub')->id())->findOrFail($orderItem);
        $order->status = 'canceled';
        $order->save();

        $rent = Rent::create([
            'start_date' => $order->start_date,
            'end_date' => $order->end_date,
            'status' => 'canceled',
            'item_id' => $order->item_id,
            'item_type' => $order->item_type,
            'price' => $order->price,
            'details' => $order->details,
            'user_id' => $order->user_id,
            'hub_id' => $order->hub_id,
        ]);
        $ItemType = $request->input('type_name');
        $item = null;
        if ($ItemType === 'desk') {
            $item = Desk::where('hub_id', auth()->guard('hub')->id())->findOrFail($order->item_id);
        } else if ($ItemType === 'room') {
            $item = Room::where('hub_id', auth()->guard('hub')->id())->findOrFail($order->item_id);
        } else if ($ItemType == 'meeting_rooms') {
            $item = MeetingRoom::where('hub_id', auth()->guard('hub')->id())->findOrFail($order->item_id);
        }
        if ($item) {
            $item->rents()->save($rent);
        }
        return redirect()->route('rent.index', ['type_name' => $request->input('type_name')])->with('success', 'Rent created successfully.');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'item_id' => 'required|integer',
            'item_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|string',
            'status' => 'nullable|string|in:pending,confirmed,canceled',
            'order_id' => 'required|integer|exists:order_items,id',
            'user_id' => 'required|integer|exists:users,id',
            'rent_types_id' => 'required|integer|exists:rent_types,id',
        ]);

        $rent = Rent::create([
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'status' => $request->input('status', 'pending'),
            'item_id' => $request->input('item_id'),
            'item_type' => $request->input('item_type'),
            'price' => $request->input('price'),
            'details' => 'hello',
            'user_id' => $request->input('user_id'),
            'hub_id' => auth()->guard('hub')->id(),
        ]);

        $ItemType = $request->input('item_type');
        $ItemId = $request->input('item_id');
        $item = null;
        if ($ItemType === 'desk') {
            $item = Desk::where('hub_id', auth()->guard('hub')->id())->findOrFail($ItemId);
        } else if ($ItemType === 'room') {
            $item = Room::where('hub_id', auth()->guard('hub')->id())->findOrFail($ItemId);
        } else if ($ItemType == 'meeting_rooms') {
            $item = MeetingRoom::where('hub_id', auth()->guard('hub')->id())->findOrFail($ItemId);
        }
        if ($item) {
            $item->rents()->save($rent);
        }

        return redirect()->route('rent.index', ['type_name' => $request->input('item_type')])->with('success', 'Rent created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $type, string $id)
    {
        if (in_array($type, ['room', 'desk', 'meeting_room'])) {
            $rents = Rent::with('item');
            if ($type == 'room') {
                $rents->whereHasMorph('item', [Room::class]);
            } elseif ($type == 'desk') {
                $rents->whereHasMorph('item', [Desk::class]);
            } elseif ($type == 'meeting_room') {
                $rents->whereHasMorph('item', [MeetingRoom::class]);
            }
            $rents = $rents->where('hub_id', auth()->guard('hub')->id())->findOrFail($id);

            return view('', [
                'rent' => $rents,
                'type' => $type,
            ]);
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($type, $id)
    {
        $hubId = auth()->guard('hub')->id();
        $desk = Desk::where('hub_id', $hubId)->get();
        $meetingRooms = MeetingRoom::where('hub_id', $hubId)->get();
        $user = User::all();
        $room = Room::where('hub_id', $hubId)->get();
        $rentTypes = RentType::where('hub_id', $hubId)->get();
        $orders = Order::with('user')->get();

        if (in_array($type, ['room', 'desk', 'meeting_rooms'])) {
            $item = Rent::with('item')
                ->whereHasMorph('item', $type == 'room' ? [Room::class] : ($type == 'desk' ? [Desk::class] : [MeetingRoom::class]))
                ->findOrFail($id);

            return view('dashboard.rent.edit', [
                'item' => $item,
                'meetingRooms' => $meetingRooms,
                'desks' => $desk,
                'users' => $user,
                'rooms' => $room,
                'rentTypes' => $rentTypes,
                'orders' => $orders,
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
        $request->validate([
            'item_id' => 'nullable|integer',
            'item_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|string',
            'status' => 'nullable|string|in:pending,confirmed,canceled',
            'order_id' => 'required|integer',
            'user_id' => 'required|integer',
            'rent_type_id' => 'required|integer|exists:rent_types,id',
        ]);
        $rent = Rent::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);
        $rent->start_date = $request->input('start_date');
        $rent->end_date = $request->input('end_date');
        $rent->status = $request->input('status', 'pending');
        $rent->item_id = $request->input('item_id');
        $rent->item_type = $request->input('item_type');
        $rent->price =  $request->input('price');
        $rent->details = 'hello';
        $rent->user_id = $request->input('user_id');
        $rent->hub_id = auth()->guard('hub')->id();
        $rent->rent_type_id = $request->input('rent_type_id');
        $itemType = $request->input('item_type');
        $itemId = $request->input('item_id');
        $item = null;
        if ($itemType === 'desk') {
            $item = Desk::where('hub_id', auth()->guard('hub')->id())->findOrFail($itemId);
        } else if ($itemType === 'room') {
            $item = Room::where('hub_id', auth()->guard('hub')->id())->findOrFail($itemId);
        } else if ($itemType === 'meeting_rooms') {
            $item = MeetingRoom::where('hub_id', auth()->guard('hub')->id())->findOrFail($itemId);
        }
        if ($item) {
            $item->rents()->save($rent);
        }

        return redirect()->route('rent.index', ['type_name' => $request->input('item_type')])->with('success', 'Rent updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Rent::where('hub_id', auth()->guard('hub')->id())->destroy($id);
        return redirect()->back();
    }
}