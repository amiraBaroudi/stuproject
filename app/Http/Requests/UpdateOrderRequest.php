<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // يجب تحديثه إذا كان هناك شرط للمصادقة
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'user_id' => 'sometimes|exists:users,user_id',
            'order_date' => 'sometimes|date',
            'pickup_address' => 'sometimes|string|max:255',
            'dropoff_address' => 'sometimes|string|max:255',
            'pickup_date' => 'sometimes|date',
            'pickup_time' => 'sometimes|date_format:H:i',
            'furniture_details' => 'sometimes|string',
            'status' => 'sometimes|in:pending,in transit,delivered',
            'person_firstname' => 'sometimes|string|max:255',
            'person_lastname' => 'sometimes|string|max:255',
            'person_phone_number' => 'sometimes|string|max:20',
            'person_email' => 'sometimes|email|max:255',
        ];
    }
}
