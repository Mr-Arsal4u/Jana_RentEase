<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'rooms_count' => 'required',
            'room_type_id' => 'required',
            'room_name' => 'required',
            'description' => 'required',
            'room_status' => 'required',
            'view_side' => 'required',
        ];
    }
}
