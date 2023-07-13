<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function hub()
    {
        return $this->belongsTo(Hub::class, 'hubs_id', 'id');
    }

    public function gallerys()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id', 'id');
    }

 
}
