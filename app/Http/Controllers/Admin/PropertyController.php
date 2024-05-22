<?php

namespace App\Http\Controllers\Admin;

use App\Models\Amenity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    public function index()
    {
        return view('admin.property.index');
    }

    public function getAmenities()
    {
        $amenities= Amenity::all();
        return view('admin.amenities.index',compact('amenities'));
    }

    public function saveAmenities(Request $request)
    {
        try {
            $amenity = new Amenity();
            $amenity->name = $request->name;
            $amenity->description = $request->description;
            $amenity->save();
            return redirect()->back()->with('success', 'Amenity added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');
            Log::error($e->getMessage());
        }
    }
}
