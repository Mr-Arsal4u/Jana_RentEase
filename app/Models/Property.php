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

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function renter()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('name', 'like', '%' . $s . '%')
            ->orWhere('description', 'like', '%' . $s . '%')
            ->orWhere('address', 'like', '%' . $s . '%')
            ->orWhere('city', 'like', '%' . $s . '%')
            ->orWhere('state', 'like', '%' . $s . '%')
            ->orWhere('zip', 'like', '%' . $s . '%')
            ->orWhere('price', 'like', '%' . $s . '%');
    }

    public function scopeFilter($query, $filters)
    {
        if ($filters['search'] ?? false) {
            $query->search($filters['search']);
        }
    }

    public function scopeFilterByAmenities($query, $amenities)
    {
        $query->whereHas('amenities', function ($query) use ($amenities) {
            $query->whereIn('amenity_id', $amenities);
        });
    }

    public function PropertyAmount()
    {
        return $this->hasMany(PropertyAmount::class);
    }
}
