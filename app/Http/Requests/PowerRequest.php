<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class PowerRequest extends CommonRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "field" => "required",
            "belong_to" => "required_without:acme",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "请输入权限名称",
            "field.required" => "字段不可为空",
            "belong_to.required_without" => "如果是顶级分类请勾选否则所属不可为空",
        ];
    }
}
