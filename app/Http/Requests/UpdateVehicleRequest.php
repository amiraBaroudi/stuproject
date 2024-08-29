<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Update as needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'driver_id' => 'sometimes|exists:drivers,driver_id',
            'vehicles_number' => 'sometimes|string|max:255',
            'capacity' => 'sometimes|integer',
        ];
    }
}
