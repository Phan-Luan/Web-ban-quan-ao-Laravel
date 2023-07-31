<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AjaxLoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ], [
            'required' => 'Không được để trống',
            'email.exists' => 'Email không tồn tại',
            'min' => 'Tối thiểu :min kí tự'
        ]);
        $data = $request->only('email', 'password');
        $checkLogin = Auth::guard('web')->attempt($data);
        if ($validator->passes() && $checkLogin) {
            // Kiểm tra mật khẩu đã nhập có khớp với mật khẩu đã mã hóa trong cơ sở dữ liệu
            $user = Auth::guard('web')->user();
            if (password_verify($data['password'], $user->password)) {
                return response()->json(['data' => $user]);
            } else {
                // Báo lỗi nếu mật khẩu không khớp
                $validator->errors()->add('password', 'Mật khẩu không đúng');
            }
        }

        return response()->json(['errors' => $validator->errors()]);
    }
}
