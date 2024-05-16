<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'property_id' => 'required',
            'renter_name' => 'required',
            'renter_email' => 'required|email',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required',
            'children' => 'required',
            'arrival_time' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'property_id.required' => 'Please select a property',
            'renter_name.required' => 'Please enter your name',
            'renter_email.required' => 'Please enter your email',
            'renter_email.email' => 'Please enter a valid email',
            'check_in.required' => 'Please select a check-in date',
            'check_in.date' => 'Please select a valid check-in date',
            'check_in.after_or_equal' => 'Check-in date must be today or later',
            'check_out.required' => 'Please select a check-out date',
            'check_out.date' => 'Please select a valid check-out date',
            'check_out.after' => 'Check-out date must be after check-in date',
            'adults.required' => 'Please enter the number of adults',
            'children.required' => 'Please enter the number of children',
            'arrival_time.required' => 'Please enter your arrival time',
        ];
    }
}
