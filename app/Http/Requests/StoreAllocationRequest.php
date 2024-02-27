<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAllocationRequest extends FormRequest
{
    
    public function rules()
    {
        $rules = [
            'emp_code' => 'required|integer',
            'device' => 'required|integer',
            'issued_on' => 'required|date',
            // 'returned_on' => 'required|date',
            'assigned_to' => 'required|string|max:255',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'emp_code.required' => 'The Employee Code field is required.',
            'device.required' => 'The device field is required.',
            'issued_on.required' => 'The issued date field is required.',
            // 'returned_on.required' => 'The returned date field is required.',
            'assigned_to.required' => 'The assigned to  field is required.',
           
        ];
    }
}
