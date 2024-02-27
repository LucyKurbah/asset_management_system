<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemTypeRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'item_type' => 'required|string|max:255',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'item_type.required' => 'The item type field is required.',
        ];
    }
}
