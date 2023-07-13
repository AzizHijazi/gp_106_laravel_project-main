<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public function hub()
    {
        return $this->belongsTo(Hub::class, 'hubs_id', 'id');
    }

    public function images(){
        return $this->hasMany(Image::class,'gallery_id','id');
    }
    
}
