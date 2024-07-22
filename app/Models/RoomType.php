<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // public function properties()
    // {
    //     return $this->belongsToMany(Property::class, 'property_room_type_counts', 'room_type_id', 'property_id')->withPivot('count');
    // }

    // public function getPropertyRoomCount($propertyId)
    // {
    //     return $this->hasOneThrough(PropertyRoomTypeCount::class, Property::class, 'room_type_id', 'id', 'id', $propertyId)
    //         ->selectRaw('room_types.*, COUNT(*) as room_count')
    //         ->groupBy('room_types.id');
    // }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function propertyAmounts()
    {
        return $this->hasOne(PropertyAmount::class);
    }

    public function hasRooms()
    {
        return $this->rooms->count() > 0;
    }
}
