<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PropertyService;

class AmenityController extends Controller
{
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
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
}
