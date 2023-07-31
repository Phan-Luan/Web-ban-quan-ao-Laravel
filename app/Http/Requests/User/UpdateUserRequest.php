<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
                Rule::unique(User::class)->ignore($this->user)
            ],
            'image' => [
                'image'
            ],
             'phone' => [
                'numeric'
            ],
            'address' => [
                'required',
            ],
            'gender'=>[
                'required'
            ]
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
