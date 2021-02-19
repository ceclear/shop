<?php

namespace App\Http\Requests;

use GenTux\Jwt\GetsJwtToken;
use Illuminate\Foundation\Http\FormRequest;

class AddAddress extends FormRequest
{
    use GetsJwtToken;

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
            'region'  => 'required',
            'address' => 'required',
            'contact' => 'required',
            'mobile'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'region.required'  => '省市区不能为空',
            'address.required' => '详细地址不能为空',
            'contact.required' => '联系人不能为空',
            'mobile.required'  => '手机不能为空',
        ];
    }
}
