<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

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

    public function rooms($type = null)
    {
        // dd($type);
        if ($type) {
            // $properties = Property::with('images')->latest()->get();
            $properties = Property::whereHas('amount', function ($query) use ($type) {
                $query->where('type', '=', $type);
            })->with(['images', 'amount'])->get();
            // dd($properties);
        } else {
            $properties = Property::with(['images','amountTypes'])->latest()->get();
        }
        // $properties = Property::where('type',$type)->with('images')->latest()->get();
        // dd($properties);
        return view('user.rooms', compact('properties'));
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
