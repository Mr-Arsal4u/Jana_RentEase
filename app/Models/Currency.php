<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function propertyAmounts()
    {
        return $this->hasMany(PropertyAmount::class);
    }
}
