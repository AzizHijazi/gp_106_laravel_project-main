<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class City extends Model
{
    use HasFactory;

    public function users()
    {

        return $this->hasMany(User::class, 'city_id', 'id');
    }

    public function visibility(): Attribute
    {
        return new Attribute(get: fn () => $this->status ? 'Active' : 'Disabled');
    }


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];
}
