<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOdfRequest extends FormRequest
{
    
    public function rules()
    {
        $rules = [
            'odf_no' => 'required|integer',
            'status' => 'required|string|max:255',
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'odf_no.required' => 'The ODF No field is required.',
            'status.required' => 'The status field is required.',
            
        ];
    }
}
