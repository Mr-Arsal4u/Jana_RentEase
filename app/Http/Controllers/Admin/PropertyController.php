<?php

namespace App\Http\Controllers\Admin;

use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Services\PropertyService;

class PropertyController extends Controller
{

    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }


    public function index()
    {
        $property_no = GeneralHelper::GENERATE_APPLICATION_NUMBER();
        $amenities = $this->propertyService->getAmenities();
        return view('admin.property.index', compact('property_no', 'amenities'));
    }

    public function getAmenities()
    {
        $amenities = $this->propertyService->getAmenities();
        return view('admin.amenities.index', compact('amenities'));
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

    public function saveProperty(Request $request)
    {
        // dd($request->all());
        try {
            $property = Property::where('property_no', $request->property_no)->first();

            if ($request->step == "1") {
                $data = $request->except('step');
                if ($property) {
                    $property->update($data);
                } {
                    Property::create($data);
                }
            }
            if ($request->step == "2" && $property) {
                $property->update($request->only(['bedrooms', 'bathrooms', 'max_persons', 'view_side', 'description']));
            }

            // if($request->has('amenities')){
            //     $property->amenities()->sync($request->amenities);
            // }

            return response()->json(['status' => 'success', 'message' => 'Property step added successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            Log::error($e->getMessage());
        }
    }

    public function savePropertyAmenities(Request $request)
    {
        // dd($request->all());
        try {
            $property = Property::where('property_no', $request->property_no)->first();

            if ($property) {
                $property->amenities()->detach();
                if ($request->has('amenities')) {
                    $property->amenities()->attach($request->amenities);
                }
                return response()->json(['status' => 'success', 'message' => 'Amenities updated successfully']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Property not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            Log::error($e->getMessage());
        }
    }


    public function savePropertyImages(Request $request)
    {
        try {
            $property = Property::where('property_no', $request->property_no)->firstOrFail();

            $property->images()->delete();

            $images = [];
            foreach ($request->file('images', []) as $image) {
                $path = $image->store('public/property_images');
                $images[] = ['image' => $path];
            }

            $property->images()->createMany($images);

            return response()->json(['status' => 'success', 'message' => 'Images uploaded successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function payment(Request $request)
    {
        try {
            $property = Property::where('property_no', $request->property_no)->firstOrFail();

            // $property->update(['status' => 'paid']);
            return response()->json(['status' => 'success', 'message' => 'Payment made successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
