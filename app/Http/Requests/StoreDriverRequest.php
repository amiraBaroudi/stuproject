<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
            'username' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'vehicle_type' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'availability' => 'required|boolean',
        ];
    }
}
    