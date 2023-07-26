<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

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
                'unique:App\models\Product,name'
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'desc'=>[
                'required',
                'string',
            ],
            'image'=>[
                'required',
                'image'
            ]
            ,
            'category_id'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Không để trống',
            'unique' => 'Tên đã tồn tại',
            'numeric'=>'Phải là số',
            'string'=>'Chỉ nhập chuỗi',
            'image'=>'Phải là hình ảnh'
        ];
    }
}
