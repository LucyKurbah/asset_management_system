<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmcRequest extends FormRequest
{
   
    public function rules()
    {
        $rules = [
          
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'vendor_name' => 'required|string|max:255',
            'vendor_email' => 'required|email',
            'vendor_phone' =>  'required|numeric|digits:10',
            'po_no' => 'required|string|max:255',
        ];
        return $rules;
    }
    public function messages()
    {
        return [
           
            'start_date.required' => 'The start date field is required.',
            'end_date.required' => 'The end date field is required.',
            'vendor_name.required' => 'The vendor name field is required.',
            'vendor_email.required' => 'The vendor email field is required.',
            'vendor_phone.required' => 'The vendor phone field is required.',
            'po_no.required' => 'The PO no field is required.',
            
        ];
    }
}
