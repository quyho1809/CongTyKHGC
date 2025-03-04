<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cho phép mọi user được update profile của mình
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:20',
            'address' => 'nullable|string|max:200',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Họ không được để trống.',
            'first_name.string' => 'Họ phải là ký tự.',
            'first_name.max' => 'Họ tối đa 30 ký tự.',
            'last_name.required' => 'Tên không được để trống.',
            'last_name.string' => 'Tên phải là ký tự.',
            'last_name.max' => 'Tên tối đa 20 ký tự.',
            'address.string' => 'Địa chỉ phải là ký tự.',
            'address.max' => 'Địa chỉ tối đa 200 ký tự.',
        ];
    }
}
