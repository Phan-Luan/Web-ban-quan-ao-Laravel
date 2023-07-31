<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            ],
            'email' => [
                'required',
                'unique:App\models\User,email',
            ],
            'password' => [
                'required',
            ],
            'image' => [
                'required',
                'image'
            ],
             'phone' => [
                'required',
                'numeric'
            ],
            'address' => [
                'required',
            ],
            'gender' => [
                'required',
            ],
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
