<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = ['name','description'];

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('name', 'like', '%' . $s . '%')
            ->orWhere('description', 'like', '%' . $s . '%');
    }

    public function scopeFilter($query, $filters)
    {
        if ($filters['search'] ?? false) {
            $query->search($filters['search']);
        }
    }
}
