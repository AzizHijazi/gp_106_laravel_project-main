<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OrderItem extends Model
{
    use HasFactory;


    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'hub_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function rentType()
    {
        return $this->belongsTo(RentType::class, 'rent_type_id', 'id');
    }

    public function item()
    {
        return $this->morphTo();
    }

    public function visibilty(): Attribute
    {
        return new Attribute(get: fn () => $this->status ? 'Approved' : 'Canceled');
    }
}
