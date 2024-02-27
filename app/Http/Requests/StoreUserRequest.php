<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'emp_code' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'group' => 'required|string|max:255',
            'password' => 'required|min:8',
            'designation' => 'required|string|max:100',
        ];
    
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'emp_code.required' => 'The Employee Code field is required.',
            'division.required' => 'The division field is required.',
            'group.required' => 'The group field is required.',
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
        ];
    }
}
