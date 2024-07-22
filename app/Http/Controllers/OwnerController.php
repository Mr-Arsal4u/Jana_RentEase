<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function ownerDashboard()
    {
        if (Auth::check() && auth()->user()->checkRole('Owner')) {
            return view('admin.index');
        }
        return redirect()->route('owner.login');
    }

    public function loginPage()
    {
        return view('owner.login');
    }

    // public function adminDashboard()
    // {
    //     return view('admin.index');
    // }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            Flasher::addSuccess('Login successful! Welcome to your dashboard.');
            return redirect()->route('owner.dashboard');
        }
        Flasher::addError('Invalid credentials. Please try again.');
        return back();
    }
}
