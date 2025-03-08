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
            'title'=>'required|string|max:100',
            'slug'=>'nullable|string|max:100|',
            'description'=>'nullable|string|max:200',
            'content'=>'nullable|string',
            'publish_date'=> 'nullable|date',
            'status'      => 'required|in:0,1,2',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết.',
            'title.max'      => 'Tiêu đề không được quá 100 ký tự.',
            'description.max'=> 'Mô tả không được quá 200 ký tự.',
        ];
    }
}
