<?php

namespace App\Helpers;

use App\Models\User;

abstract class UserHelper
{

    public static function getUser($request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return $user->id;
        }else{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password ?? bcrypt('password');
            // $user->role = 'user';
            $user->assignRole('user');
            // $user->email_verified_at = now();
            $user->save();
            return $user->id;
        }
    }
}
