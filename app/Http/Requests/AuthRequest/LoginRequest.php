<?php

namespace App\Http\Requests\AuthRequest;

use Illuminate\Foundation\Http\FormRequest;
use Password;
use PharIo\Manifest\Email;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];
    }
     public function messages(): array
    {
        return [
            'email.required' => 'vui lòng nhập thông tin tài khoản!',
            'email.email' => 'tài khoản không đúng định dạng!',
            'email.exists' => 'tài khoản không tồn tại!',
            'password.required' => 'vui lòng nhập mật khẩu!'
        ];
    }
}
