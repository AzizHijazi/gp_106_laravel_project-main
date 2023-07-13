<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemComponent extends Model
{
    use HasFactory;
    public function item()
    {
        return $this->morphTo();
    }

    public function component()
    {
        return $this->belongsTo(Component::class, 'component_id', 'id');
    }
}
