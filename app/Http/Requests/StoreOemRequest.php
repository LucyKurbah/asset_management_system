<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOemRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'oem' => 'required|string|max:255',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'oem.required' => 'The OEM field is required.',
        ];
    }
}
