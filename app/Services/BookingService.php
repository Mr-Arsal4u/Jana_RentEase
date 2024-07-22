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

            // dd($request->property_id);
            $checkInDate = Carbon::parse($request->check_in)->format('Y-m-d');
            $checkOutDate = Carbon::parse($request->check_out)->format('Y-m-d');
            $property = Property::findOrFail($request->property_id);

            // dd($property);
            $bookings = self::bookingsBydate($request->property_id, $checkInDate, $checkOutDate);
            if ($bookings->count() > 0) {
                return back()->with('error', 'Property is already booked for the selected dates');
            }
            $booking = new Booking();
            $booking->check_in = $request->check_in;
            $booking->check_out = $request->check_out;
            $booking->days = GeneralHelper::calculateDays($request->check_in, $request->check_out);
            $booking->adults = $request->adults;
            $booking->children = $request->children;
            $booking->arrival_time = $request->arrival_time;
            $booking->rooms_booked = $request->rooms_booked;
            $booking->property_id = $property->id;
            $booking->total_cost = self::calculateTotalCost($property, $booking->days, $booking->rooms_booked);
            $booking->user_id = auth()->id() ?? UserHelper::getUser($request);

            $booking->save();

            // dd('here');
            // UserHelper::sendBookingEmail($booking);
            // return redirect()->route('payment.create', ['property' => $property->id, 'booking' => $booking->id]);
            return redirect()->route('payment.create', [
                // 'property_id' => $property->id,/
                'booking_id' => $booking->id,
            ]);
            // return view('user.payment', ['property_id' => $property->id, 'booking_id' => $booking->id]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'An error occurred while creating the booking');
            // return response()->json(['error' => 'An error occurred while creating the booking'], 500);
        }
    }

    public function bookingsBydate($property_id, $checkInDate, $checkOutDate)
    {
        return $this->getBookings()->where('property_id', $property_id)
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->where('check_in', '<', $checkOutDate)
                    ->where('check_out', '>', $checkInDate);
            })->get();
    }

    public function calculateTotalCost($property, $days, $rooms)
    {
        // dd($property->PropertyAmount->total_amount * $days * $rooms);
        return $property->PropertyAmount->total_amount * $days * $rooms;
    }
}
