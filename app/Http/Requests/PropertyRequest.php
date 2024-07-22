<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'property_no' => 'required',
            'property_name' => 'required',
            'location' => 'required',
            'zip_code' => 'required',
            'property_area' => 'required',
            // 'description' => 'required',
            'city' => 'required',
            'country' => 'required',
            'total_rooms' => 'required',
            // 'amenities' => 'required',
            'total_rooms' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'property_no.required' => 'Property Number is required',
            'property_name.required' => 'Property Name is required',
            'location.required' => 'Location is required',
            'zip_code.required' => 'Zip Code is required',
            'property_area.required' => 'Property Area is required',
            'description.required' => 'Description is required',
            'city.required' => 'City is required',
            'country.required' => 'Country is required',
            'total_rooms.required' => 'Total Rooms is required',
            'amenities.required' => 'Amenities is required',
        ];
    }
}
