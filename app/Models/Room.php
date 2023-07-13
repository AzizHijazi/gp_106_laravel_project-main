<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Room extends Model
{
    use HasFactory;


  
    protected $hidden = [
        'created_at',
        'updated_at',
        'hub_id',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];


    public function hub()
    {
        return $this->belongsTo(Hub::class, 'hub_id', 'id');
    }

    public function itemComponents()
    {
        return $this->morphMany(ItemComponent::class, 'item', 'item_id', 'item_type', 'id');
    }

    public function orders()
    {
        return $this->morphMany(Order::class, 'item', 'item_type', 'item_id', 'id');
    }
    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'item', 'item_type', 'item_id', 'id');
    }
    public function prices()
    {
        return $this->morphMany(Price::class, 'item', 'item_type', 'item_id', 'id');
    }

    public function rents()
    {
        return $this->morphMany(Rent::class, 'item', 'item_type', 'item_id', 'id');
    }


    public function visibilty(): Attribute
    {
        return new Attribute(get: fn () => $this->status ? 'Available' : 'UnAvailable');
    }
}
