<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\ComponentType;

class Component extends Model
{
    use HasFactory;

    public function status(): Attribute
    {
        return new Attribute(get: fn () => $this->condition ? 'Good' : 'Bad');
    }

    public function componentType()
    {
        return $this->belongsTo(ComponentType::class, 'component_type_id', 'id');
    }

    public function itemComponents()
    {
        return $this->hasMany(ItemComponent::class, 'component_id', 'id');
    }
}
