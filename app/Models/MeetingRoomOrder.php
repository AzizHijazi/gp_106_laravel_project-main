<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingRoomOrder extends Model
{
    use HasFactory;

    public function meeting_room(){
        return $this->belongsTo(MeetingRoom::class,'hub_id','id');
    }

    public function hub()
    {
        return $this->belongsTo(Hub::class, 'hub_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
