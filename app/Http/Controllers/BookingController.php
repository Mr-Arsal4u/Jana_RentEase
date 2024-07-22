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
use App\Services\PropertyService;

class BookingController extends Controller
{

    protected $bookingsService;
    protected $propertyService;

    public function __construct(BookingService $bookingsService, PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
        $this->bookingsService = $bookingsService;
    }

    public function index()
    {
        return view('user.booking');
    }

    public function saveBooking(BookingRequest $request)
    {
        return $this->bookingsService->saveBooking($request);
    }


    public function createBooking($id)
    {
        $property = $this->propertyService->getProperties()->where('id', $id)->first();
        
        // return view('user.property.property-bookings', compact('property'));
        return view('user.property.accordion-booking', compact('property'));

    }
}
