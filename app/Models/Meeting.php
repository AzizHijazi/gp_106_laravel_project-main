<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Meeting extends Model
{
    use HasFactory;


    public function visibilty(): Attribute
    {
        return new Attribute(get: fn () => $this->status ? 'Running' : 'Finished');
    }

    public function meetingRoom()
    {
        return $this->belongsTo(MeetingRoom::class, 'meeting_room_id', 'id');
    }

    public function rent()
    {
        return $this->belongsTo(Rent::class, 'rent_id', 'id');
    }
}
