<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFurnitureRequest extends FormRequest
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
            'category' => 'sometimes|in:sofa,chair,table',
            'type' => 'sometimes|in:wooden,metal,glass',
            'description' => 'sometimes|string',
            'quantity' => 'sometimes|integer',
        ];
    }
}
