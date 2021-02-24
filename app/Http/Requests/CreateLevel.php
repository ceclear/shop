<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLevel extends FormRequest
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
            'level'         => 'required',
            'step'          => 'required|in:1,2,3',
            'op_str'        => 'required',
            'first_op_min'  => 'required',
            'first_op_max'  => 'required',
            'second_op_min' => 'required',
            'second_op_max' => 'required',
            'count'         => 'required',
            'rel_min'       => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'level.required'         => '请选择年级',
            'step.required'          => '请选择几步运算',
            'step.in'                => '几步运算超出范围',
            'op_str[].required'      => '请选择运算符',
            'first_op_min.required'  => '请输入第一算数项最小值',
            'first_op_max.required'  => '请输入第一算数项最大值',
            'second_op_min.required' => '请输入第二算数项最小值',
            'second_op_max.required' => '请输入第二算数项最大值',
            'count.required'         => '请输入题目总数',
            'rel_min.required'       => '请输入结果最小值',
            'rel_min.min'            => '结果最小值不能小于1',
        ];
    }
}
