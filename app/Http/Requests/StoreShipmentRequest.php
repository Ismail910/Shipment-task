<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           
            'shipper' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'weight' => 'required|numeric|min:0.01', 
            'description' => 'required',
           
        ];
    }

    public function messages(): array
    {
        return [
            'shipper.required' => 'The shipper field is required.',
            'image.required' => 'The image field is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
            'weight.required' => 'The weight field is required.',
            'weight.numeric' => 'The weight must be a numeric value.',
            'weight.min' => 'The weight must be greater than or equal to 0.01.',
            'description.required' => 'The description field is required.',
        ];
    }
}
