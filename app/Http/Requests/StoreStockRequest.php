<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockRequest extends FormRequest
{
    
    public function rules()
    {
        $rules = [
            'stock_register_entry' => 'required|string|max:255',
            
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'stock_register_entry.required' => 'The stock register entry field is required.',
           
        ];
    }
}
