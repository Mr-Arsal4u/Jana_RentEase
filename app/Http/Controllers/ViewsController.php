<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ViewsController extends Controller
{


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

  

    public function blog()
    {
        return view('user.blog');
    }

    public function blogDetails()
    {
        return view('user.blog-details');
    }
}
