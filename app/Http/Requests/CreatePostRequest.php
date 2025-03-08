<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:100',
            'description'  => 'nullable|string|max:200',
            'content'      => 'required|string',
            'publish_date' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'  => 'Vui lòng nhập tiêu đề bài viết.',
            'title.max'       => 'Tiêu đề không được quá 100 ký tự.',
            'description.max' => 'Mô tả không được quá 200 ký tự.',
            'thumbnail.image' => 'File phải là hình ảnh.',
            'thumbnail.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'thumbnail.max' => 'Ảnh không được lớn hơn 2MB.'
        ];
    }
}

