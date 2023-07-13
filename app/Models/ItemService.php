<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemService extends Model
{
   use HasFactory;

   public function hub()
   {
      return $this->belongsTo(Hub::class, 'hub_id', 'id');
   }

   public function service()
   {
      return $this->belongsTo(Service::class, 'service_id', 'id');
   }
}
