<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    
    public function rules()
    {
            $rules = [
                'po_no' => 'required|string|max:255',
                'install_date' => 'required|date',
                'delivery_date' => 'required|date',
                'warranty_from' => 'required|date',
                'warranty_to' => 'required|date',
                'purchased_by' => 'required|string|max:255',
            ];
            return $rules;
    }
    public function messages()
    {
        return [
            'po_no.required' => 'The PO No field is required.',
            'install_date.required' => 'The installation date field is required.',
            'delivery_date.required' => 'The delivery date field is required.',
            'warranty_from.required' => 'The warranty date field is required.',
            'warranty_to.required' => 'The warranty date field is required.',
            'purchased_by.required' => 'The purchased by field is required.',
            
        ];
    }
}
