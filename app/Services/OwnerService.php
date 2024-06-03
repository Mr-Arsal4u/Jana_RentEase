<?php 

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OwnerService

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
}