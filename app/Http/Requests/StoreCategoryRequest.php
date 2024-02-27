<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'category' => 'required|string|max:255',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'category.required' => 'The Category name field is required.',
        ];
    }
}
