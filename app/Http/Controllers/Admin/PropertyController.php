<?php

namespace App\Http\Controllers\Admin;

use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\PropertyAmount;
use App\Services\PropertyService;
use Generator;

class PropertyController extends Controller
{

    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }


    public function index()
    {
        $properties = $this->propertyService->getProperties(request());
        if (request()->ajax()) {
            return response()->json($properties);
        }
        return view('admin.property.index', compact('properties'));
    }

    public function create()
    {
        $property_no = GeneralHelper::GENERATE_APPLICATION_NUMBER();
        $amenities = $this->propertyService->getAmenities();
        $currencies = $this->propertyService->getCurrency();
        return view('admin.property.create', compact('property_no', 'amenities', 'currencies'));
    }


    public function getAmenities()
    {
        $amenities = $this->propertyService->getAmenities();
        return view('admin.amenities.index', compact('amenities'));
    }

    public function deleteAmenities($id)
    {
        return $this->propertyService->deleteAmenity($id);
    }

    public function saveAmenities(Request $request)
    {
        return $this->propertyService->createAmenity($request);
    }

    public function saveProperty(Request $request)
    {
        $response =  $this->propertyService->saveProperty($request);
        return response()->json($response);
    }

    public function savePropertyAmenities(Request $request)
    {
        // dd($request->all());
        $response = $this->propertyService->savePropertyAmenities($request->property_no, $request->amenities);
        return response()->json($response);
    }


    public function savePropertyImages(Request $request)
    {
        $response = $this->propertyService->savePropertyImages($request);
        return response()->json($response);
    }

    public function getFee(Request $request)
    {
        $response = $this->propertyService->getFee($request);
        return response()->json($response);
    }

    public function submitApplication(Request $request)
    {
        $response = $this->propertyService->submitApplication($request);
        return response()->json($response);
    }
}
