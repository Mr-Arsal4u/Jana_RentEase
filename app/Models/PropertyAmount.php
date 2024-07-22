<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAmount extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
