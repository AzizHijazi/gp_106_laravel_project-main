<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Hub extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'email',
    ];


    public function workingTimes()
    {
        return $this->hasMany(WorkingTime::class, 'hub_id', 'id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'hub_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'hub_id', 'id');
    }

    public function meetingRooms()
    {
        return $this->hasMany(MeetingRoom::class, 'hub_id', 'id');
    }

    public function desks()
    {
        return $this->hasMany(Desk::class, 'hub_id', 'id');
    }

    public function contactRequests()
    {
        return $this->morphMany(ContactRequest::class, 'actor');
    }


    public function componentTypes()
    {
        return $this->hasMany(ComponentType::class, 'hub_id', 'id');
    }

    public function internetAccounts()
    {

        return $this->hasMany(InternetAccount::class, 'hub_id', 'id');
    }

    public function rentTypes()
    {

        return $this->hasMany(RentType::class, 'hub_id', 'id');
    }

    public function services()
    {

        return $this->hasMany(Service::class, 'hub_id', 'id');
    }

    public function gallerys(){
        return $this->hasMany(Gallery::class,'hub_id','id');
    }

    public function images(){
        return $this->hasMany(Image::class,'hub_id','id');
    }

    public function contactRequsets()
    {
        return $this->morphMany(ContactRequest::class, 'actor', 'actor_type', 'actor_id', 'id');
    }
}
