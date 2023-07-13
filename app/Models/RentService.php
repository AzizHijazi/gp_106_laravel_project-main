<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentService extends Model
{
    use HasFactory;

    public function rent()
    {
        return $this->belongsTo(Rent::class, 'rents_id', 'id');
    }

    public function itemService()
    {
        return $this->belongsTo(ItemService::class, 'item_Service_id', 'id');
    }
}
