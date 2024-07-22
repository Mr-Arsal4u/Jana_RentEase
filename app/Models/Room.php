<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model 
{
    use HasFactory;

    // protected $fillable = ['name', 'description', 'capacity', 'status'];
    protected $guarded = [];

    public function renter()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function roomAmount()
    {
        return $this->hasOne(PropertyAmount::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    
}
