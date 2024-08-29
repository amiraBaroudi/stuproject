<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;



class StoreFurnitureRequest extends FormRequest
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
            'size' => ['required', Rule::in(['Small', 'Medium', 'Large'])],
            'type' => ['required', Rule::in(['fragile', 'non-fragile'])],
            'name' => 'required|string|max:255',
        ];
    }
}
