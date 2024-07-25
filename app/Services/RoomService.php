<?php

namespace App\Services;

use App\Models\Room;
use App\Models\Currency;
use App\Models\Property;
use App\Models\RoomType;
use App\Helpers\GeneralHelper;
use App\Models\PropertyAmount;
use App\Services\PropertyService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class RoomService
{
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    public function getAllRooms($propertyId = null)
    {
        // dd(request()->all());
        // dd($propertyId);
        $query = Room::ApplyFilter(request()->only(['from', 'to', 'room_no', 'roomType']))->with('property', 'roomType');

        if ($propertyId) {
            $query->where('property_id', $propertyId);
        }
        return $query->get();
        // dd($room);
    }

    // public function getPropertyRooms($propertyId)
    // {
    //     // dd($propertyId);
    //     $query = Room::ApplyFilter(request()->only(['from', 'to', 'room_no', 'roomType']))->with('property', 'roomType');

    //     if ($propertyId) {
    //         $query->where('property_id', $propertyId);
    //     }
    //     return $query->get();
    // }

    public function getRoom($roomNo)
    {
        return Room::where('room_no', $roomNo)->with('property', 'roomType')->first();
    }

    public function rooms($id)
    {
        try {
            // dd($id);
            if (!$id) {
                return response()->json(['error' => 'Property not found'], 404);
            }
            // $rooms = $this->getAllRooms(request())->where('property_id', $id);
            $rooms = $this->getAllRooms($id);
            // dd($rooms);
            $property = $this->propertyService->getProperties()->where('id', $id)->first();
            $roomTypes = RoomType::all();
            // dd($roomTypes);
            if (request()->ajax()) {
                $rooms_view = $this->filterEachRecord($rooms);
                return response()->json([
                    'data' => $rooms_view,
                    'success' => true,
                    // 'pagination' => $paginationHtml
                ]);
            }

            return view('admin.property.room.rooms', compact('rooms', 'roomTypes', 'property'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'An error occurred while fetching properties');
        }
    }

    public function filterEachRecord($rooms)
    {
        $rooms_view = '';
        if ($rooms->count() > 0) {
            foreach ($rooms as $room) {
                $view = (string)view('admin.property.room.room_tr', compact('room'));
                $rooms_view = $rooms_view . $view;
            }
        } else {
            $view = (string)view('admin.property.room.room_tr');
            $rooms_view = $rooms_view . $view;
        }
        return $rooms_view;
    }
    // {
    //     // dd($property);
    //     $rooms_view = '';
    //     if ($property->count() > 0) {
    //         // dd('here');
    //         foreach ($property->rooms as $room) {
    //             // dd($room);
    //             $view = (string)view('admin.property.room.room_tr', compact('room'));
    //             $rooms_view = $rooms_view . $view;
    //         }
    //     } else {
    //         $view = (string)view('admin.property.room.room_tr');
    //         $rooms_view = $rooms_view . $view;
    //     }
    //     return $rooms_view;
    // }

    public function store($request)
    {
        try {
            $property = Property::find($request->property_id);
            $roomType = RoomType::find($request->room_type_id);

            if (!$property || !$roomType) {
                return response()->json(['error' => 'Property or Room Type not found'], 404);
            }
            $roomCount = $request->rooms_count;
            $roomsCreated = 0;
            // dd($request->all());
            Log::info('Current Room Type Count: ' . $roomType->rooms->count());
            Log::info('Property Room Count: ' . $property->total_rooms);
            Log::info('Requested Rooms Count: ' . $request->rooms_count);
            // dd($roomType->rooms->count() > $property->room_count, $request->rooms_count > $property->room_count);
            if ($roomType->rooms->count() > $property->total_rooms || $request->rooms_count > $property->total_rooms) {
                return response()->json(['error' => 'Rooms count exceeds property room count'], 422);
            }
            // if($request->rooms_count > $property->room_count){
            //     return response()->json(['error' => 'Room count exceeds property room count']);
            // }
            if ($roomType->rooms->count() === $roomCount) {
                $roomType->rooms()->update([
                    'room_name' => $request->room_name,
                    'room_status' => $request->room_status,
                    'description' => $request->description,
                    'view_side' => $request->view_side,

                ]);
            } else {
                for ($i = 0; $i < $roomCount; $i++) {
                    $roomNo = GeneralHelper::ROOM_NO('RN-', 4);
                    $room = new Room([
                        'room_no' => $roomNo,
                        'room_name' => $request->room_name,
                        'property_id' => $property->id,
                        'room_type_id' => $roomType->id,
                        'room_status' => $request->room_status,
                        'description' => $request->description,
                        'view_side' => $request->view_side,

                    ]);
                    $room->save();
                    $roomsCreated++;
                }
            }
            return response()->json(['status' => 'success', 'message' => "Rooms created successfully", 'count' => $roomsCreated]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred while creating rooms']);
        }
    }

    public function storeRoomInfo($request)
    {
        // dd($request->all());
        // dd($request->except('rooms_count'));
        try {
            // dd($request->room_type_id);
            // $room = self::getRoom($request->room_type_id);
            $roomType = RoomType::where('id', $request->room_type_id)->first();
            // dd($roomType->rooms->isEmpty());
            if (!$roomType || $roomType->rooms->isEmpty()) {
                return response()->json(['error' => 'Room Type or Rooms not found'], 404);
            }
            $roomType->rooms()->update($request->except('rooms_count'));
            return response()->json(['status' => 'success', 'message' => 'Room information updated successfully']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred while updating room information']);
        }
    }

    public function submitRoomForm($request)
    {
        try {
            // dd($request->all());
            $fee = GeneralHelper::calculateFee($request->room_price);

            // $room = Room::where('room_no', $request->room_no)->first();
            $roomType = RoomType::where('id', $request->room_type_id)->first();
            // dd($roomType->rooms->isEmpty());
            if (!$roomType || $roomType->rooms->isEmpty()) {
                return response()->json(['error' => 'Room Type or Rooms not found'], 404);
            }

            $roomType->rooms()->update($request->except('room_price', 'currency', 'rooms_count'));

            $currency = Currency::where('id', $request->currency)->first();
            // dd($amount);
            // dd();
            $amount = new PropertyAmount();
            $amount->room_type_id = $request->room_type_id;
            $amount->total_amount = $fee['total_amount'];
            $amount->user_amount = $fee['owner_amount'];
            $amount->admin_amount = $fee['fee'];
            $amount->tax = 0.015;
            $amount->currency_id = $currency->id;
            $amount->save();

            return response()->json(['status' => 'success', 'message' => 'Room information submitted successfully'], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred while submitting room information'], 500);
        }
    }

    public function getFee($request)
    {
        try {
            // dd($request->all());
            // $room = Room::where('room_no', $request->room_no)->with('property')->first();
            // $room = self::getRoom($request->room_no);
            $roomType = RoomType::where('id', $request->roomType)->first();
            // dd($room);
            if (!$roomType) {
                return response()->json(['error' => 'Room Type not found'], 404);
            }
            $property = $roomType->property;
            $fee = GeneralHelper::calculateFee($request->amount);
            // dd($fee['total_amount']);
            $currency = Currency::where('id', $request->currency)->pluck('code')->first();
            // dd($currency);
            // dd('here');
            $contract = GeneralHelper::applicationContract($roomType->rooms, $currency, $fee, $property);
            // dd($contract);
            return response()->json(['status' => 'success', 'contract' => $contract]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function addRoomsType($request)
    {
        try {
            // dd($request->all());

            // if ($request->room_type_name == null || $request->room_type_description == null) {
            //     return response()->json(['status' => 'error', 'message' => 'Please fill all fields'], 422);
            // }

            $existingRoomType = RoomType::where('property_id', $request->property_id)
                ->where('name', $request->room_type_name)
                ->exists();

            if ($existingRoomType) {
                return response()->json(['status' => 'error', 'message' => 'Room Type already exists for this property'], 422);
            }

            $roomType = new RoomType();
            $roomType->property_id = $request->property_id;
            $roomType->name = $request->room_type_name;
            $roomType->description = $request->room_type_description;
            // $roomType->room_count = $request->rooms_count;
            $roomType->save();

            // $roomTypeCount=PropertyService::getLeftRoomsCount($properties);
            $properties = $this->propertyService->getProperties();
            $roomTypeCount = $this->propertyService->getLeftRoomsCount($properties);
            return response()->json(['status' => 'success', 'message' => 'Room Type added successfully', 'roomTypeCount' => $roomTypeCount]);
            // return response()->json(['status' => 'success', 'message' => 'Room Type added successfully']);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred while adding room type'], 500);
        }
    }

    // public function getRoomTypes($request, $id)
    // {

    // }
}
