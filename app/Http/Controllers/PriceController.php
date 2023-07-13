<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Models\Price;
use App\Models\Room;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($type)
    {
        //
        if (in_array($type, ['room', 'desk'])) {
            $price = Price::with('item');
            $price = $type == 'room'
                ? $price->whereHasMorph('item', [Room::class])->get()
                : $price->whereHasMorph('item', [Desk::class])->get();

            return view('dashboard.prices.index', [
                'prices' => $price,
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
        $room = Room::all();
        $desk = Desk::all();
        return view('', ['rooms' => $room, 'desks' => $desk]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'item_id' => 'nullable|integer',
            'item_type' => 'required|string|max:255',
            'primary_price' => 'required|float',
            'price' => 'required|float',
        ]);

        $price = new Price();
        $price->item_id = $request->input('item_id');
        $price->item_type = $request->input('item_type');
        $price->primary_price = $request->input('primary_price');
        $price->price = $request->input('price');

        if ($request->input('item_type') === 'desk') {
            $desk = Desk::findOrFail($request->input('item_id'));
            $desk->prices()->save($price);
        } else if ($request->input('item_type') === 'room') {
            $room = Room::findOrFail($request->input('item_id'));
            $room->prices()->save($price);
        }
        return redirect()->route('');
    }

    /**
     * Display the specified resource.
     */
    public function show($type, string $id)
    {
        //
        if (in_array($type, ['room', 'desk'])) {
            $price = Price::with('item');
            $price = $type == 'room'
                ? $price->whereHasMorph('item', [Room::class])
                : $price->whereHasMorph('item', [Desk::class]);

            $price = $price->findOrFail($id);

            // TODO Edit    
            return view('dashboard.prices.index', [
                'prices' => $price,
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
        //
        $room = Room::all();
        $desk = Desk::all();
        if (in_array($type, ['room', 'desk'])) {
            $price = Price::with('item');
            $price = $type == 'room'
                ? $price->whereHasMorph('item', [Room::class])
                : $price->whereHasMorph('item', [Desk::class]);

            $price = $price->findOrFail($id);

            // TODO Edit    
            return view('dashboard.prices.index', [
                'prices' => $price,
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
            'item_id' => 'nullable|integer',
            'item_type' => 'required|string|max:255',
            'primary_price' => 'required|float',
            'price' => 'required|float',
        ]);

        $price =  Price::findOrFail($id);
        $price->item_id = $request->input('item_id');
        $price->item_type = $request->input('item_type');
        $price->primary_price = $request->input('primary_price');
        $price->price = $request->input('price');

        if ($request->input('item_type') === 'desk') {
            $desk = Desk::findOrFail($request->input('item_id'));
            $desk->prices()->save($price);
        } else if ($request->input('item_type') === 'room') {
            $room = Room::findOrFail($request->input('item_id'));
            $room->prices()->save($price);
        }
        return redirect()->route('');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Price::destroy($id);
        return redirect()->back();
    }
}
