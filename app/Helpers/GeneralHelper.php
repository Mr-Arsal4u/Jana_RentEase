<?php

namespace App\Helpers;

use App\Models\Room;
use App\Models\Property;

abstract class GeneralHelper

{

    public static function formatDate()
    {
        return date('d F Y');
    }
    public static function RANDOM_STRING($prefix = 'PN-', $length = 4): string
    {
        $characters = '0123456789PQWUAGDALSKDJ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $prefix . $randomString;
    }

    public static function ROOM_NO($prefix = 'RN-', $length = 4): string
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $unique = false;
        $randomString = '';

        while (!$unique) {
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $roomNo = $prefix . $randomString;

            if (!Room::where('room_no', $roomNo)->exists()) {
                $unique = true;
            }
        }

        return $roomNo;
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

    public static function calculateFee($price)
    {
        // dd($price);
        $adminFee = $price * 0.015;
        $ownerAmount = $price - $adminFee;
        return [
            'fee' => $adminFee,
            'owner_amount' => $ownerAmount,
            'total_amount' => $price,
        ];
    }

    public static function applicationContract($data, $currency, $fee, $property)
    {
        // Property details
        $propertyName = $property['property_name'];
        $propertyLocation = $property['location'];
        $totalRooms = $property['total_rooms'];
        $propertyCity = $property['city'];
    
        // Start contract HTML
        $contractHTML = '
            <div class="container">
                <h2>Application Contract</h2>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Property Details</h4>
                        <p><strong>Property Name:</strong> ' . $propertyName . '</p>
                        <p><strong>Location:</strong> ' . $propertyLocation . '</p>
                        <p><strong>Total Rooms:</strong> ' . $totalRooms . '</p>
                        <p><strong>City:</strong> ' . $propertyCity . '</p>
                    </div>
                    <div class="col-md-6">
                        <h4>Contract Summary</h4>
                        <p><strong>Total Amount:</strong> $' . $fee['total_amount'] . '</p>
                        <p><strong>Admin\'s Fee:</strong> $' . $fee['fee'] . '</p>
                        <p><strong>Your Amount:</strong> $' . $fee['owner_amount'] . '</p>
                        <p><strong>Currency:</strong> ' . $currency . '</p>
                    </div>
                </div>
                <hr>';
    
        // Iterate over each room to display room numbers only
        // $contractHTML .= '<div class="row"><div class="col-md-12"><h4>Room Numbers</h4><ul>';
        // foreach ($data as $room) {
        //     $contractHTML .= '<li>Rooms Numbers: ' . $room['room_no'] . '</li>';
        // }
        $contractHTML .= '</ul></div></div><hr>';
    
        // Closing part of the contract HTML
        $contractHTML .= '
                <p>By clicking on Submit button, you agree to the terms and conditions outlined above and your application will be submitted.</p>
            </div>
        ';
    
        return $contractHTML;
    }
    

    public static function generate_property_card($properties)
    {
        $htmlContent = ''; // Start building your HTML content

        foreach ($properties as $property) {
            $htmlContent .= '<div class="col-lg-6">' .
                '<div class="room-wrap d-md-flex">' .
                '<a href="#" class="img" style="background-image: url(images/room-1.jpg);"></a>' .
                '<div class="half left-arrow d-flex align-items-center">' .
                '<div class="text p-4 p-xl-5 text-center">' .
                '<p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>' .
                '<h3 class="mb-3"><a href="rooms.html">' . $property->property_name . '</a></h3>' .
                '<ul class="list-accomodation">' .
                '<li><span>Max:</span>' . $property->max_persons . '</li>' .
                '<li><span>Size:</span> ' . $property->area . ' SQFT</li>' .
                '<li><span>View:</span>' . $property->view_side . '</li>' .
                '<li><span>Bed:</span>' . $property->bedrooms . '</li>' .
                '</ul>' .
                '<p class="pt-1"><a id="book_apartment" onclick="propertyModal(\'' . $property->id . '\')" class="btn-custom px-3 py-2">View Room Details <span class="icon-long-arrow-right"></span></a></p>' .
                '</div>' .
                '</div>' .
                '</div>';
            return response()->json(['htmlContent' => $htmlContent]);
        }
    }

    public static function calculateDays($checkIn, $checkOut)
    {
        $checkIn = strtotime($checkIn);
        $checkOut = strtotime($checkOut);
        $datediff = $checkOut - $checkIn;
        return round($datediff / (60 * 60 * 24));
    }
}
