<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class WorkingTime extends Model
{
    use HasFactory;

    public function hub()
    {
        return $this->belongsTo(Hub::class, 'hub_id', 'id');
    }

    public function visibilty(): Attribute
    {
        return new Attribute(get: fn () => $this->status ? 'Available' : 'UnAvailable');
    }
}
