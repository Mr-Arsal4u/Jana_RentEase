<?php

namespace App\Http\Controllers\admin;

use App\Models\Room;
use App\Models\Currency;
use App\Models\Property;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Services\RoomService;
use App\Helpers\GeneralHelper;
use App\Services\PropertyService;
use App\Http\Requests\RoomRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomTypeRequest;

class RoomController extends Controller
{

    protected $roomService;
    protected $propertyService;

    public function __construct(RoomService $roomService, PropertyService $propertyService)
    {
        $this->roomService = $roomService;
        $this->propertyService = $propertyService;
    }

    public function rooms($id)
    {
        // dd($id);
        return $this->roomService->rooms($id);
    }

    public function create(Request $request)
    {
        // dd('here');
        try {
            // dd('heer');
            $property = Property::find($request->property_id);
            $room_no = GeneralHelper::ROOM_NO('RN-');
            // dd($room_no);
            $currencies = Currency::all();
            $roomTypes = RoomType::where('property_id', $request->property_id)->get();
            return view('admin.property.room.create-room', compact('property', 'room_no', 'currencies', 'roomTypes'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'An error occurred while fetching properties');
        }
    }

    public function store(RoomRequest $request)
    {

        return $this->roomService->store($request);
    }

    public function storeRoomInfo(Request $request)
    {
        return $this->roomService->storeRoomInfo($request);
    }

    public function getFee(Request $request)
    {
        return $this->roomService->getFee($request);
    }

    public function submitRoomForm(Request $request)
    {
        return $this->roomService->submitRoomForm($request);
    }

    public function addRoomsType(RoomTypeRequest $request)
    {
        // dd($request);
        return $this->roomService->addRoomsType($request);
    }

    // public function getRoomTypes(Request $request, $id)
    // {
    //    return $this->roomService->getRoomTypes($request, $id);
    // }

    public function getRoomTypes(Request $request, $id)
    {
        try {
            $roomTypes = RoomType::where('property_id', $id)->get();
            $property = $this->propertyService->getProperties()->find($id);
            $properties = $this->propertyService->getProperties($request);
            // dd($properties);
            $leftRoomsCount = $this->propertyService->getLeftRoomsCount($properties);
            // dd($leftRoomsCount);
            return view('admin.property.room.room-types', compact('roomTypes', 'property', 'leftRoomsCount'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'An error occurred while fetching room types');
        }
    }
}
