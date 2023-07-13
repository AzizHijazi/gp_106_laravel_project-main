<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'status',
        'item_id',
        'item_type',
        'price',
        'order_items_id',
        'user_id',
        'hub_id',
        'rent_type_id',
        'details',
    ];


    protected $hidden = [
        'hub_id',
        'user_id',
        'created_at',
        'updated_at',
        'order_items_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function item()
    {
        return $this->morphTo();
    }

    public function meetings()
    {

        return $this->hasMany(Meeting::class, 'rent_id', 'id');
    }
}
