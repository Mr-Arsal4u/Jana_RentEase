<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    public function index()
    {
        return view('user.booking');
    }

    public function saveBooking(BookingRequest $request)
    {
        // dd($request->all());
        try {

            $property = Property::findOrFail($request->property_id);
            // dd('here');
            // dd($property);
            $hour = $request->arrival_time;
            $period = $request->period;

            // Assuming $request contains the data from your form
            $checkInDate = Carbon::createFromFormat('m/d/Y', $request->input('check_in'))->format('Y-m-d');
            $checkOutDate = Carbon::createFromFormat('m/d/Y', $request->input('check_out'))->format('Y-m-d');
            
            // Now you can save $checkInDate and $checkOutDate to the database
            
            $booking = new Booking();
            $booking->check_in = $checkInDate;
            $booking->check_out = $checkOutDate;
            $booking->days = self::calculateDays($request->check_in, $request->check_out);
            $booking->adults = $request->adults;
            $booking->children = $request->children;
            $booking->email = $request->renter_email;
            $booking->renter_name = $request->renter_name;
            $booking->arrival_time = $hour . ' ' . $period;
            $booking->arrival_time = $request->arrival_time;
            $booking->property_id = $property->id;
            $booking->renter_id = auth()->id() ?? 1;
            $booking->save();

            return redirect()->back()->with('success', 'Booking has been saved successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the booking. Please try again later');
        }
    }

    private function calculateDays($checkIn, $checkOut)
    {
        $checkIn = strtotime($checkIn);
        $checkOut = strtotime($checkOut);
        $datediff = $checkOut - $checkIn;
        return round($datediff / (60 * 60 * 24));
    }

    public function getBookings($id) {
        $bookings = Booking::where('property_id', $id)->get(['check_in', 'check_out']);
        return response()->json($bookings);
    }   
    
}
