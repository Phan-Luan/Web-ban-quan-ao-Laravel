<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
                Rule::unique(Product::class)->ignore($this->product)
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'desc' => [
                'required',
                'string',
            ],
            'image' => [
                'image'
            ],
            'category_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Không để trống',
            'unique' => 'Tên đã tồn tại',
            'numeric' => 'Phải là số',
            'string' => 'Chỉ nhập chuỗi',
            'image' => 'Phải là hình ảnh'
        ];
    }
}
