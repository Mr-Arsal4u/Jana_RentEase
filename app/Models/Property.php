<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];


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

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function roomTypes()
    {
        return $this->hasMany(RoomType::class);
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('property_name', 'like', '%' . $s . '%')
            ->orWhere('city', 'like', '%' . $s . '%');
    }

    public function scopeApplyFilter($query, $filters)
    {
        if ($filters['name'] ?? false) {
            $query->search($filters['name']);
        }
        if ($filters['from'] ?? false) {
            $query->where('created_at', '>=', $filters['from']);
        }
        if ($filters['to'] ?? false) {
            $query->where('created_at', '<=', $filters['to']);
        }
    }

    public function scopeFilterByAmenities($query, $amenities)
    {
        $query->whereHas('amenities', function ($query) use ($amenities) {
            $query->whereIn('amenity_id', $amenities);
        });
    }
}
