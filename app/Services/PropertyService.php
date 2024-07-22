<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use App\Models\Amenity;
use App\Models\Booking;
use App\Models\Currency;
use App\Models\Property;
use App\Models\RoomType;
use App\Helpers\GeneralHelper;
use App\Models\PropertyAmount;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Log;
use App\Models\PropertyRoomTypeCount;
use Illuminate\Support\Facades\Storage;

class PropertyService
{
    public function getProperties()
    {
        $properties = Property::ApplyFilter(request()->only(['from', 'to', 'name']))->with('amenities', 'roomTypes')->get();
        return $properties;
    }

    public function getFilteredProperties($request)
    {
        $propertiesByCity = self::getProperties()->where('city', $request->city);
        $checkIn = Carbon::parse($request->check_in)->format('Y-m-d');
        $checkOut = Carbon::parse($request->check_out)->format('Y-m-d');

        $allBookings = Booking::whereIn('property_id', $propertiesByCity->pluck('id'))
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where('check_in', '>=', $checkIn)
                    ->where('check_out', '<=', $checkOut);
            })->get()
            ->pluck('property_id')
            ->toArray();
        // dd($allBookings);
        $properties = $propertiesByCity->filter(function ($property) use ($allBookings) {
            return !in_array($property->id, $allBookings);
        });
        // dd($properties);
        return $properties;
    }

    public function getRoomTypes()
    {
        $roomTypes = RoomType::get();
        return $roomTypes;
    }

    public function getAmenities()
    {
        $amenities = Amenity::where('status', 1)->get();
        return $amenities;
    }

    public function deleteAmenity($id)
    {
        try {
            $amenity = Amenity::find($id);
            $amenity->delete();
            return back()->with('success', 'Amenity deleted successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'An error occurred');
        }
    }

    // public function getProperty($id)
    // {
    //     $property = Property::find($id);
    //     return $property;
    // }
    // public function saveProperty($request)
    // {
    //     // dd($request->all());
    //     try {
    //         $property = $this->getProperties()->where('property_no', $request->property_no)->first();
    //         // dd($property);
    //         if ($request->step == "1") {
    //             // dd($request);
    //             $data = $request->except('step');
    //             if ($property) {
    //                 $property->update($data);
    //             } else {
    //                 Property::create($data);
    //             }
    //         }
    //         if ($request->step == "2" && $property) {
    //             // dd('here');
    //             $property->update($request->only(['bedrooms', 'bathrooms', 'max_persons', 'view_side', 'description']));
    //         }
    //         return response()->json(['status' => 'success', 'message' => 'Property step added successfully']);
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    //         Log::error($e->getMessage());
    //     }
    // }

    public function saveProperty($request)
    {
        try {
            $property = $this->getProperties()->where('property_no', $request->property_no)->first();
            if ($property) {
                $property->update($request->all());
            } else {
                Property::create($request->all());
            }
            return response()->json(['status' => 'success', 'message' => 'Property added successfully']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function saveRoomsCount($propertyNo, $totalRooms, $roomCounts)
    {
        // dd($request->all());
        try {
            $property = $this->getProperties()->where('property_no', $propertyNo)->first();
            if ($property) {
                $property->update(['total_rooms' => $totalRooms]);
                PropertyRoomTypeCount::where('property_id', $property->id)->delete();
                foreach ($roomCounts as $roomTypeId => $count) {
                    PropertyRoomTypeCount::create([
                        'property_id' => $property->id,
                        'room_type_id' => $roomTypeId,
                        'count' => $count
                    ]);
                }
            }
            return response()->json(['status' => 'success', 'message' => 'Rooms count added successfully']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function getCurrency()
    {
        $currency = Currency::get();
        return $currency;
    }

    public function savePropertyImages($request)
    {
        // dd($request->description);
        try {
            $property = self::getProperties()->where('property_no', $request->property_no)->first();
            if ($property) {
                $property->update([
                    'description' => $request->description,
                    'application_status' => $request->status

                ]);
                $oldImages = $property->images;
                if ($oldImages->isNotEmpty()) {
                    $property->images()->delete();
                    Storage::delete($oldImages->pluck('image')->toArray());
                }
            }
            $images = [];
            foreach ($request->file('images', []) as $image) {
                $path = $image->store('public/property_images');
                $images[] = ['image' => $path];
            }
            $property->images()->createMany($images);
            return response()->json(['status' => 'success', 'message' => 'Images uploaded successfully']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function savePropertyAmenities($propertyNo, $amenities)
    {
        try {
            $property = $this->getProperties()->where('property_no', $propertyNo)->first();
            if ($property) {
                $property->amenities()->detach();
                if (!empty($amenities)) {
                    $property->amenities()->attach($amenities);
                }
                return ['status' => 'success', 'message' => 'Amenities updated successfully'];
            } else {
                return ['status' => 'error', 'message' => 'Property not found'];
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function createAmenity($request)
    {
        try {
            Amenity::create($request->all());
            // Amenity::create([$request->all()]);     $request->all();
            return redirect()->back()->with('success', 'Amenity added successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function submitApplication($request)
    {
        try {
            $fee = GeneralHelper::calculateFee($request->amount);
            $currency = $this->getCurrency()->where('id', $request->currency)->first();
            // dd($currency);
            $property = $this->getProperties()->where('property_no', $request->property_no)->first();
            $property->update(['application_status' => $request->status]);
            $amount = new PropertyAmount();
            $amount->property_id = $property->id;
            $amount->total_amount = $fee['total_amount'];
            $amount->user_amount = $fee['owner_amount'];
            $amount->admin_amount = $fee['fee'];
            $amount->tax = 0.015;
            $amount->currency_id = $currency->id;
            $amount->save();
            return response()->json(['status' => 'success', 'message' => 'Application submitted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function getLeftRoomsCount($properties)
    {
        $leftRoomsCount = 0;

        foreach ($properties as $property) {
            $total_count = $property->total_rooms;
            $rooms_count = $property->roomTypes->sum('room_count');
            $leftRoomsCount = $total_count - $rooms_count;
        }
        return $leftRoomsCount;
    }

    public function filterEachRecord($properties)
    {
        $properties_view = '';
        if ($properties->count() > 0) {
            foreach ($properties as $property) {
                $property_view = (string)view('admin.property.table', compact('property'));
                $properties_view = $properties_view . $property_view;
            }
        } else {
            $property_view = (string)view('admin.property.table');
            $properties_view = $properties_view . $property_view;
        }
        return $properties_view;
    }

    public function deleteProperty($id)
    {
        try {
            // $property = Property::find($id);
            $property = $this->getProperties()->where('id', $id)->first();
            $property->amenities()->delete();
            $property->images()->delete();
            $property->rooms()->delete();
            $property->reviews()->delete();
            $property->roomTypes()->delete();
            $property->delete();
            return ['status' => 'success', 'message' => 'Property deleted successfully'];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ['status' => 'error', 'message' => 'An error occurred'];
        }
    }
}
