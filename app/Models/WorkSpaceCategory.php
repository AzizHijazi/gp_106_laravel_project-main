<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class WorkSpaceCategory extends Model
{
    use HasFactory;

    public function visibility(): Attribute
    {
        return new Attribute(get: fn () => $this->status ? 'Active' : 'Disabled');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
