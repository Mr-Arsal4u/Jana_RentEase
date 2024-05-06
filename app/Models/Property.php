<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    public function renter()
    {
        return $this->belongsTo(User::class, 'renter_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }   
}
