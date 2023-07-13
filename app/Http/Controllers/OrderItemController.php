<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Models\DeskType;
use App\Models\Hub;
use App\Models\MeetingRoomOrder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Rent;
use App\Models\RentType;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use DateTime;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $type)
    {
        //
        if (in_array($type, ['room', 'desk'])) {
            //Request - API - Accept: application/json
            $orderItems = OrderItem::with('item');
            $orderItems = $type == 'room'
                ? $orderItems->whereHasMorph('item', [Room::class])->get()
                : $orderItems->whereHasMorph('item', [Desk::class])->get();

            return view('dashboard.order_items.index', [
                'orderItems' => $orderItems,
                'type' => $type,
            ]);
        }
        abort(404);
    }

    /**
     * Display a listing of The Pending Orders For the Authorized User.
     */
    public function myOrders(Request $request)
    {
        $request->validate([
            'type' => 'nullable|in:pending,confirmed',
        ]);

        $query = OrderItem::where('user_id', Auth::user()->id);
        if ($request->type == 'pending') {
            $query->where('status', $request->type);
        } else if ($request->type == 'confirmed') {
            $query->where('status', $request->type);
        }

        $orderItems = $query->with('item')->get();
        $count = $orderItems->count();
        foreach ($orderItems as $orderItem) {
            if ($orderItem->item_type === 'App\Models\Desk') {
                $desk = DeskType::find($orderItem->item->desk_type_id);
                $orderItem->item->size = $desk->count;
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'Successfully',
            'count' => $count,
            'data' => $orderItems,
        ]);
    }







    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'order_item_id' => 'required|integer',
            'order_item_type' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'hub_id' => 'required|exists:hubs,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], Response::HTTP_OK);
        }

        $orderItems = new OrderItem();
        $orderItemType = $request->input('order_item_type');
        $orderItemId = $request->input('order_item_id');
        $orderItems->item_id = $request->input('order_item_id');
        $orderItems->item_type = $request->input('order_item_type');
        $orderItems->details = $request->input('details');
        $orderItems->hub_id = $request->input('hub_id');
        $orderItems->user_id = auth()->id();
        $orderItems->start_date = $request->input('start_date');
        $orderItems->end_date = $request->input('end_date');

        // Generate unique order ID
        $orderId = $this->generateOrderId();
        $orderItems->order_id = $orderId;

        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));
        $numberOfDays = $startDate->diffInDays($endDate);
        $item = null;

        if ($orderItemType === 'desk') {
            $item = Desk::where('hub_id', $request->input('hub_id'))->findOrFail($orderItemId);
        } elseif ($orderItemType === 'room') {
            $item = Room::where('hub_id', $request->input('hub_id'))->findOrFail($orderItemId);
        }

        if ($item) {
            $total = $item->price;
            $orderItems->price = $total;
            $item->orderItems()->save($orderItems);
        }

        return response()->json(['status' => true, 'message' => 'Ordered Successfully', 'data' => $orderItems], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     * 
     */
    public function show($type, string $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($type, $id)
    {
        $hubId = auth()->guard('hub')->user()->id; // Access the user instance and then get the id

        $desk = Desk::where('hub_id', $hubId)->get();
        $user = User::all();
        $room = Room::where('hub_id', $hubId)->get();
        $rentTypes = RentType::where('hub_id', $hubId)->get();
        $orders = Order::with('user')->get();

        if (in_array($type, ['room', 'desk'])) {
            $orderItems = OrderItem::with('item')
                ->whereHasMorph('item', $type == 'room' ? [Room::class] : [Desk::class]);

            $orderItems = $orderItems->findOrFail($id);

            return view('dashboard.order_items.edit', [
                'orderItems' => $orderItems,
                'desks' =>  $desk,
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
            'order_item_id' => 'required|integer',
            'order_item_type' => 'required|string|max:255',
            'status' => 'nullable|string|in:pending,confirmed,canceled',
            'details' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        $orderItems = OrderItem::findOrFail($id);
        $orderItems->item_id = $request->input('order_item_id');
        $orderItems->item_type = $request->input('order_item_type');
        $orderItems->details = $request->input('details');
        $orderItems->status = $request->input('status', 'pending');
        $orderItems->hub_id = auth()->guard('hub')->id();
        $orderItems->user_id = auth()->id();
        $orderItems->start_date = $request->input('start_date');
        $orderItems->end_date = $request->input('end_date');
        $startDate = new DateTime($request->input('start_date'));
        $endDate = new DateTime($request->input('end_date'));
        $interval = $startDate->diff($endDate);
        $numberOfDays = $interval->days;
        $object = $request->input('order_item_type');
        if ($object === 'desk') {
            $desk = Desk::where('hub_id', auth()->guard('hub')->id())->findOrFail($request->input('order_item_id'));
            $total = $numberOfDays * $desk->price;
            $orderItems->price = $total;
            $desk->orderItems()->save($orderItems);
        } else if ($object === 'room') {
            $room = Room::where('hub_id', auth()->guard('hub')->id())->findOrFail($request->input('order_item_id'));
            $total = $numberOfDays * $room->price;
            $orderItems->price = $total;
            $room->orderItems()->save($orderItems);
        }
        return redirect()->route('order_items.index', ['type_name' => $request->input('order_item_type')])->with('success', 'Updated Successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $orderItem = OrderItem::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);
        $orderItem->delete();
        return redirect()->back();
    }


    private function generateOrderId()
    {
        $timestamp = time(); // Unix timestamp (seconds)
        $orderId = date('Ymd-His-', $timestamp) . mt_rand(1000, 9999); // Generate timestamp-based order ID
        return $orderId;
    }
}