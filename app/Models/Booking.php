<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    //changed the property to room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    
    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('check_in', 'like', '%' . $s . '%')
            ->orWhere('check_out', 'like', '%' . $s . '%')
            ->orWhere('status', 'like', '%' . $s . '%');
    }

    public function scopeFilter($query, $filters)
    {
        if ($filters['search'] ?? false) {
            $query->search($filters['search']);
        }
    }
    
}
