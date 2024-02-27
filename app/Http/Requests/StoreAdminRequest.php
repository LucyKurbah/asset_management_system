<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            
            'password' => 'required|min:8',
        ];
    
        return $rules;
    }

    public function messages()
    {
        return [
            
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
        ];
    }
}
