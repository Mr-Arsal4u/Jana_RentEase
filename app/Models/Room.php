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


    // public function images()
    // {
    //     return $this->hasMany(Image::class);
    // }

    public function scopeWhereRoomType($query, $id)
    {
        $query->where('room_type_id', $id);
    }

    public function scopeWhereRoomNo($query, $room_no)
    {
        // dd($room_no,'11');
        return $query->where('room_no', 'like', '%' . $room_no . '%');
    }


    public function scopeApplyFilter($query, array $filters)
    {

        $filters = collect($filters);
        // dd($filters);
        if ($filters->get('from')) {
            $query->where('created_at', '>=', $filters->get('from'));
        }
        if ($filters->get('to')) {
            $query->where('created_at', '<=', $filters->get('to'));
        }
        if ($filters->get('room_no')) {
            $query->whereRoomNo($filters->get('room_no'));
        }
        if ($filters->get('roomType')) {
            $query->whereRoomType($filters->get('roomType'));
        }
    }
}
