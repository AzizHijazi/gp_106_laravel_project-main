<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Component;

class ComponentType extends Model
{
    use HasFactory;


    public function hub()
    {
        return $this->belongsTo(Hub::class, 'hub_id', 'id');
    }

    public function components()
    {
        return $this->hasMany(Component::class, 'component_type_id', 'id');
    }
}
