<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskType extends Model
{
    use HasFactory;

    public function desks()
    {
        return $this->hasMany(Desk::class, 'desk_type_id', 'id');
    }
}
