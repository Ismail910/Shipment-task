<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJournalEntityRequest extends FormRequest
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
            'amount' => 'required|numeric|min:0.01', 
            'type' => 'required|in:Debit Cash,Credit Revenue,Credit Payable',
            'shipment_id' => 'required|exists:shipments,id',
        ];
    }

  
    public function messages(): array
    {
        return [
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a numeric value.',
            'amount.min' => 'The amount must be greater than or equal to 0.01.',
            'type.required' => 'The type field is required.',
            'type.in' => 'The selected type is invalid.',
            'shipment_id.required' => 'The shipment ID field is required.',
            'shipment_id.exists' => 'The selected shipment ID is invalid.',
        ];
    }
}