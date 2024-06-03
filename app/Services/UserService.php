<?php

namespace App\Services;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService

{

    public function authenticate($request)
    {
        try {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // if (Auth::user()->hasRole('renter')) {
                //     return redirect()->route('owner.login')->with('info', 'Property Owners Please login via this route!');
                // }
                return redirect()->route('index')->with('success', 'Login successful!');
            } else {

                return redirect()->back()->with('error', 'Invalid email or password');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'An Error occured please try again');
        }
    }
    public function register($request)
    {
        try {
            if (User::where('email', $request->email)->exists()) {
                $user = User::updateOrCreate([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->assignRole('renter');
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->assignRole('renter');
            }
            return redirect()->route('index')->with('success', 'Registration successful!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'An Error occured please try again');
        }
    }

    public function updateProfile($request)
    {
        try {
            $user = Auth::user();
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('profile')->with('success', 'Profile updated successfully!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'An Error occured please try again');
        }
    }
}
