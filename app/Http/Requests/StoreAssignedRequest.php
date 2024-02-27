<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssignedRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'assigned' => 'string',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'assigned' => 'The Assigned To field is required.',
        ];
    }
}
