<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
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
            'username' => 'sometimes|string|max:255',
            'license_number' => 'sometimes|string|max:255',
            'vehicle_type' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:8',
            'availability' => 'sometimes|boolean',
        ];
    }
}
