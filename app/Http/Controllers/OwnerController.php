<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function ownerDashboard()
    {
        // auth()->checkRole('owner');
        return view('owner.index');
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
            return redirect()->route('owner.dashboard');
        }
        return back()->withErrors('Invalid Credentials');
  }

}
