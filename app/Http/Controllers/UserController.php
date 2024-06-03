<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('user.index');
    }

    public function profile()
    {
        return view('user.auth.profile');
    }

    public function login()
    {
        return view('user.auth.login');
    }

    public function register()
    {
        return view('user.auth.register');
    }

    public function authenticate(Request $request)
    {
        return $this->userService->authenticate($request);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index')->with('success', 'Logout successful!');
    }

    public function store(Request $request)
    {

        return $this->userService->register($request);
    }

    public function updatePassword()
    {
        return view('user.email.update-password');
    }

    public function updateProfile(Request $request)
    {
       return $this->userService->updateProfile($request);
    }
}
