<?php

namespace App\Http\Controllers\Admin;

use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\Image;
use App\Models\PropertyAmount;
use App\Models\Room;
use App\Models\RoomType;
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
            $properties_view = $this->propertyService->filterEachRecord($properties);
            // $paginationHtml = GeneralHelper::GET_PAGINATION($properties);
            return response()->json(
                [
                    'data' => $properties_view,
                    'success' => true,
                    // 'pagination' => $paginationHtml
                ]
            );
            // dd($properties_view);
            // return response()->json($properties);
        }
        $leftRoomsCount = $this->propertyService->getLeftRoomsCount($properties);

        return view('admin.property.index', compact('properties', 'leftRoomsCount'));
    }

    public function create()
    {
        $property_no = GeneralHelper::GENERATE_APPLICATION_NUMBER();
        $amenities = $this->propertyService->getAmenities();
        $currencies = $this->propertyService->getCurrency();
        $roomTypes = $this->propertyService->getRoomTypes();
        return view('admin.property.create', compact('property_no', 'amenities', 'currencies', 'roomTypes'));
    }

    public function saveProperty(PropertyRequest $request)
    {
        $response =  $this->propertyService->saveProperty($request);
        return response()->json($response);
    }

    public function saveRoomsCount(Request $request)
    {
        $response = $this->propertyService->saveRoomsCount($request->property_no, $request->total_rooms, $request->room_counts);
        return response()->json($response);
    }

    public function savePropertyAmenities(Request $request)
    {
        $request->validate([
            'property_no' => 'required',
            'amenities' => 'required'
        ]);
        $response = $this->propertyService->savePropertyAmenities($request->property_no, $request->amenities);
        return response()->json($response);
    }

    public function savePropertyImages(Request $request)
    {
        $response = $this->propertyService->savePropertyImages($request);
        return response()->json($response);
    }

    public function submitApplication(Request $request)
    {
        $response = $this->propertyService->submitApplication($request);
        return response()->json($response);
    }

    public function delete($id)
    {
        $response = $this->propertyService->deleteProperty($id);
        return response()->json($response);
    }
}
