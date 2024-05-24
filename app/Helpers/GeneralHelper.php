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

    public static function applicationContract($data, $fee, $currency)
    {

        // dd($fee, $currency);
        // Extract property details from $data
        $propertyName = $data['property_name'];
        $propertyLocation = $data['location'];
        $propertyArea = $data['area'];
        $propertyCity = $data['city'];
    //    dd($fee['total_amount']);
        // $currncy =currency ;
        // dd($propertyName, $propertyLocation, $propertyArea, $propertyCity);
        // Generate the HTML for the contract
        $contractHTML = '
       
            <div class="container">
                <h2>Application Contract</h2>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Property Details</h4>
                        <p><strong>Property Name:</strong> ' . $propertyName . '</p>
                        <p><strong>Location:</strong> ' . $propertyLocation . '</p>
                        <p><strong>Area:</strong> ' . $propertyArea .  ' Square Feets</p>
                        <p><strong>City:</strong> ' . $propertyCity .  '</p>
                    </div>
                    <div class="col-md-6">
                        <h4>Contract Summary</h4>
                        <p><strong>Total Amount:</strong>$' . $fee['total_amount'] . '</p>
                        <p><strong>Admin\'s Fee :</strong> $' . $fee['fee'] . '</p>
                        <p><strong>Your Amount:</strong> $' . $fee['owner_amount'] . '</p>
                        <p><strong>Currency:</strong> ' . $currency . '</p>
                    </div>
                </div>
                <hr>
                <p>By clicking on save button , you agree to the terms and conditions outlined above and your Application will be submitted.</p>
            </div>
        ';

        // Return the generated HTML
        return $contractHTML;
    }
}
