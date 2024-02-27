<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDivisionRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'division' => 'string',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'division' => 'The Division field is required.',
        ];
    }
}
