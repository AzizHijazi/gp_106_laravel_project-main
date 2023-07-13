<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentType extends Model
{
    use HasFactory;

    public function visibilty(): Attribute
    {
        return new Attribute(get: fn () => $this->status ? 'Active' : 'InActive');
    }

    public function hub()
    {

        return $this->belongsTo(Hub::class, 'hub_id', 'id');
    }
}
