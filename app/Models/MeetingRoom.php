<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class   MeetingRoom extends Model
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

    public function visibilty(): Attribute
    {
        return new Attribute(get: fn () => $this->status ? 'Available' : 'UnAvailable');
    }

    public function meeting_room_orders()
    {
        return $this->hasMany(MeetingRoomOrder::class, 'hub_id', 'id');
    }

    public function rents()
    {
        return $this->morphMany(Rent::class, 'item', 'item_type', 'item_id', 'id');
    }

    public function meetings()
    {

        return $this->hasMany(Meeting::class, 'meeting_room_id', 'id');
    }

    public function itemComponent()
    {
        return $this->morphMany(ItemComponent::class, 'item', 'item_id', 'item_type', 'id');
    }

    public function hub()
    {
        return $this->belongsTo(Hub::class, 'hub_id', 'id');
    }
}
