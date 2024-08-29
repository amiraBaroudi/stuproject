<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'user_id' => 'required|exists:users,user_id',
            'order_date' => 'required|date',
            'pickup_address' => 'required|string|max:255',
            'dropoff_address' => 'required|string|max:255',
            'pickup_date' => 'required|date',
            'pickup_time' => 'required|date_format:H:i',
            'furniture_details' => 'required|string',
            'status' => 'required|in:pending,in transit,delivered',
            'person_firstname' => 'required|string|max:255',
            'person_lastname' => 'required|string|max:255',
            'person_phone_number' => 'required|string|max:20',
            'person_email' => 'required|email|max:255',

            // التحقق من صحة بيانات قطع الأثاث
            'furniture' => 'required|array',
            'furniture.*.name' => 'required|string|max:255',
            'furniture.*.size' => 'required|in:Small,Medium,Large',
            'furniture.*.type' => 'required|in:fragile,non-fragile',
        ];
    }
}
