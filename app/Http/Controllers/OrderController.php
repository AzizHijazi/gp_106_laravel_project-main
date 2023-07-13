<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Models\Hub;
use App\Models\Order;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $orders = Order::all();
        if ($request->expectsJson()) {
            return response()->json(['status' => true, 'data' => $orders], Response::HTTP_OK);
        } else {
            return view('dashboard.orders.index', [
                'orders' => $orders,
            ]);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $hubs = Hub::all();
        $users = User::all();
        $room = Room::all();
        $desk = Desk::all();
        return view('dashboard.orders.create', ['hubs' => $hubs, 'users' => $users, 'rooms' => $room, 'desks' => $desk]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'total' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        $order = new Order();
        $order->total = $request->input('total');
        $order->user_id = $request->input('user_id');
        $saved = $order->save();

        if ($request->expectsJson()) {
            return response()->json(['status' => true, 'message' => 'success', 'data' => $order], Response::HTTP_OK);
        }

        return redirect()->route('orders.create')->with('success', 'Order created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $orders = Order::with('user')->findOrFail($id);
        $hubs = Hub::all();
        $users = User::all();
        $room = Room::all();
        $desk = Desk::all();
        return view('dashboard.orders.edit', ['orders' => $orders, 'hubs' => $hubs, 'users' => $users, 'rooms' => $room, 'desks' => $desk]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'total' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);
        $order = Order::findOrFail($id);
        $order->total = $request->input('total');
        $order->user_id = $request->input('user_id');
        $saved = $order->save();
        return redirect()->route('orders.index', 'desk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Order::destroy($id);
        return redirect()->back();
    }
}
