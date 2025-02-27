<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                'password'   => 'required|min:8|string|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*?])[A-Za-z\d!@#$%^&*?]{8,}$/',
                'password_confirmation' => 'same:password',
            

        ];
    }
}
