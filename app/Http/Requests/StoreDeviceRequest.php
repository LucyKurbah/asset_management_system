<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'serial_no' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'item_type' => 'required|string|max:255',
            'oem' => 'required|string|max:255',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'serial_no.required' => 'The Serial No field is required.',
            'category.required' => 'The Category name field is required.',
            'item_type.required' => 'The item type field is required.',
            'oem.required' => 'The OEM field is required.',
        ];
    }
}
