<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomTypeRequest extends FormRequest
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
        // dd(request()->all());
        return [
            'property_id' => 'required|exists:properties,id',
            'room_type_name' => 'required|string|max:255',
            'room_type_description' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'property_id.required' => 'Property is required',
            'name.required' => 'Room Type name is required',
            'description.required' => 'Room Type description is required',
        ];
    }
}
