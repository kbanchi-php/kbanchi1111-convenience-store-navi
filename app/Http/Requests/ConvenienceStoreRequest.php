<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvenienceStoreRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'category' => 'required|integer',
            'address' => 'required|string|max:100',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => '',
            'pr' => 'max:3000',
            'toilet' => 'required|boolean',
            'parking' => 'required|integer',
        ];
    }
}
