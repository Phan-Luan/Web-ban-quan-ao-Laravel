<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique(Category::class)->ignore($this->category)
            ],
            'desc' => [
                'required',
                'string'
            ],
            'image' => [
                'image'
            ]
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Không để trống',
            'unique' => 'Tên đã tồn tại',
            'string' => 'Chỉ nhập chuỗi',
            'image' => 'Phải là hình ảnh',
        ];
    }
}
