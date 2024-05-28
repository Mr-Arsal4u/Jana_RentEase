<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Property;
use App\Helpers\UserHelper;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Log;

class BookingService
{

    public function getBookings()
    {
        return Booking::query();
    }

    public function saveBooking($request)
    {
        try {

            $checkInDate = Carbon::parse($request->check_in)->format('Y-m-d');
            $checkOutDate = Carbon::parse($request->check_out)->format('Y-m-d');
            $property = Property::findOrFail($request->property_id);
            $hour = $request->arrival_time;
            $period = $request->period;
            $time = $hour . ' ' . $period;

            $bookings = self::bookingsBydate($request->property_id, $checkInDate, $checkOutDate);
            if ($bookings->count() > 0) {
                return response()->json(['error' => 'Property is already booked for the selected dates'], 500);
            }
            $booking = new Booking();
            $booking->check_in = $request->check_in;
            $booking->check_out = $request->check_out;
            $booking->days = GeneralHelper::calculateDays($request->check_in, $request->check_out);

            $booking->adults = $request->adults;
            $booking->children = $request->children;
            // dd('here');

            $booking->arrival_time = $time;

            // $booking->arrival_time = $request->arrival_time;
            $booking->property_id = $property->id;

            $booking->user_id = auth()->id() ?? UserHelper::getUser($request);

            $booking->save();
            // dd('here');

            return response()->json(['success' => 'Booking Created successfully']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred while creating the booking'], 500);
        }
    }

    public function bookingsBydate($property_id, $checkInDate, $checkOutDate)
    {
        // dd($this->getBookings()); 
        return $this->getBookings()->where('property_id', $property_id)
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->where('check_in', '<', $checkOutDate)
                    ->where('check_out', '>', $checkInDate);
            })->get();
    }
}
