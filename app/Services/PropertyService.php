<?php

namespace App\Services;

use App\Models\Amenity;
use App\Models\Currency;
use App\Models\Property;

class PropertyService
{
    public function getProperties()
    {
        $properties = Property::get();
        return $properties;
    }

    public function getAmenities()
    {
        $amenities = Amenity::where('status',1)->get();
        return $amenities;
    }

    // public function getProperty($id)
    // {
    //     $property = Property::find($id);
    //     return $property;
    // }

    public function getCurrency()
    {
        $currency = Currency::get();
        return $currency;
    }
}
