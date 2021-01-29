<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class LoginMember extends FormRequest
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
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'email不能为空',
            'password.required' => 'password不能为空',
        ];
    }
}
