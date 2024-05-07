<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index()
    {
        return view('user.booking');
    }

    public function saveBooking(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'property_id' => 'required',
                'renter_name' => 'required',
                'renter_email' => 'required|email',
                'check_in' => 'required|date',
                'check_out' => 'required|date',
                'adults' => 'required',
                'children' => 'required',
                'arrival_time' => 'required',
            ]);

            $property = Property::findOrFail($request->property_id);
            // dd('here');
            // dd($property);
            $hour= $request->arrival_time;
            $period = $request->period;

            $booking = new Booking();
            $booking->check_in = $request->check_in;
            $booking->check_out = $request->check_out;
            $booking->days = self::calculateDays($request->check_in, $request->check_out);
            $booking->adults = $request->adults;
            $booking->children = $request->children;
            $booking->email = $request->renter_email;
            $booking->renter_name = $request->renter_name;
            $booking->arrival_time =$hour. ' '. $period;
            $booking->arrival_time = $request->arrival_time  ;
            $booking->property_id = $property->id;
            $booking->renter_id = auth()->id() ?? 1;
            $booking->save();

            return redirect()->back()->with('success', 'Booking has been saved successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the booking');
        }
    }

    private function calculateDays($checkIn, $checkOut)
    {
        $checkIn = strtotime($checkIn);
        $checkOut = strtotime($checkOut);
        $datediff = $checkOut - $checkIn;
        return round($datediff / (60 * 60 * 24));
    }
}
