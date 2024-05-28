<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BookingRequest;
use App\Services\BookingService;

class BookingController extends Controller
{

    private $bookingsService;

    public function __construct(BookingService $bookingsService)
    {
        $this->bookingsService = $bookingsService;
    }

    public function index()
    {
        return view('user.booking');
    }

    public function saveBooking(BookingRequest $request)
    {
        // dd($request->all());
      return $this->bookingsService->saveBooking($request);
    }


    public function getBookings($id)
    {
        $bookings = Booking::where('property_id', $id)->get(['check_in', 'check_out']);
        return response()->json($bookings);
    }
}
