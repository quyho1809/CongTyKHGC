<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:30|string',
            'last_name'  => 'required|max:30|string',
            'email'      => 'required|max:100|email|unique:users',
            'password' => [
                'required',
                'string',
                Password::min(8)  
                    ->letters()   
                    ->mixedCase() 
                    ->numbers()   
                    ->symbols(), 
                'confirmed'      
            ],
        ];

        
    }
}
