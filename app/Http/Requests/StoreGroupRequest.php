<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'group' => 'string',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'group' => 'The Group Name field is required.',
        ];
    }
}
