<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class RegisterMember extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:members,email|email:rfc,dns',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'first name不能为空',
            'last_name.required' => 'last name不能为空',
            'email.required' => 'email不能为空',
            'email.email' => 'email格式不对',
            'email.unique' => 'email已经使用了',
            'password.required' => 'password不能为空',
            'password_confirmation.required' => 'confirm_password不能为空',
            'password.confirmed' => '密码不一致',
        ];
    }
}
