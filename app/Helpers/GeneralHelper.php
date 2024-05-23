<?php

namespace App\Helpers;

use App\Models\Property;

abstract class GeneralHelper

{

    public static function formatDate()
    {
        return date('d F Y');
    }
    public static function RANDOM_STRING($length = 4): string
    {
        $characters = '0123456789PQWUAGDALSKDJ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return 'PN-' . $randomString;
    }
    
    public static function GENERATE_APPLICATION_NUMBER()
    {
        $property_no = GeneralHelper::RANDOM_STRING();
        $existing_no = Property::where('property_no', $property_no)->first();
        if ($existing_no) {
            $property_no = GeneralHelper::RANDOM_STRING();
        }
        return $property_no;
    }
}
