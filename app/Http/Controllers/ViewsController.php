<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function index()
    {
        return view('user.index');
    }
    
    public function aboutUs()
    {
        return view('user.about');
    }

    public function contactUs()
    {
        return view('user.contact');
    }

    public function services()
    {
        return view('user.services');
    }

    public function rooms()
    {
        return view('user.rooms');
    }

    public function roomDetails()
    {
        return view('user.room-details');
    }

    public function blog()
    {
        return view('user.blog');
    }

    public function blogDetails()
    {
        return view('user.blog-details');
    }

    
}
