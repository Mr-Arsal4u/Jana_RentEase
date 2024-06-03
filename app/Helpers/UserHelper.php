<?php

namespace App\Helpers;

use App\Models\User;
use App\Mail\PasswordMail;
use Illuminate\Support\Facades\Mail;

abstract class UserHelper
{

    public static function getUser($request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {

            return $user->id;
        }else{
            $password = bcrypt('password');
            $request->merge(['password' => $password]);
            $user = User::create($request->all());
            $user->assignRole('Renter');
            // Mail::to($user->email)->send(new PasswordMail($user, $password));
            // self::sendBookingEmail($user);
            return $user->id;
        }
    }

    public static function sendBookingEmail($booking)
    {
        $user = User::find($booking->user_id);
        $property = $booking->property;
        $data = [
            'name' => $user->name,
            'property' => $property->name,
            'check_in' => $booking->check_in,
            'check_out' => $booking->check_out,
            'days' => $booking->days,
            'adults' => $booking->adults,
            'children' => $booking->children,
            'arrival_time' => $booking->arrival_time,
        ];
        // $user->notify(new BookingNotification($data));
    }
}
