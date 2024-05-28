<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Models\Property;
use App\Services\PropertyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PropertiesController extends Controller
{
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    public function index(Request $request)
    {
        $properties = $this->propertyService->getProperties()->where('application_status', 'Complete');
        if ($request->ajax()) {
            $properties = $this->propertyService->getFilteredProperties($request);
            $content = GeneralHelper::generate_property_card($properties);
            return response()->json(['content' => $content]);
        }
        return view('user.index', compact('properties'));
    }

    // public function findProperty(Request $request)
    // {
    //     try {
    //         $properties = Property::where('city', $request->city);

    //         // return redirect()->back()->with()
    //     } catch (Exception $e) {
    //         Log::error($e->getMessage());
    //         return back()->with('error', 'An Error occured please try again');
    //     }
    // }
}
