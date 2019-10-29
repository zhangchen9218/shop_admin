<?php

namespace App\Http\Requests;


class AdminRequest extends CommonRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $data = [];
        if($this->route()->uri() == "admin/adn"){
            $data = [
                "account" => "required|min:8|max:20|unique:admins,account",
                "password" => "required|min:8|max:20|confirmed",
                "password_confirmation" => "required|same:password",
                "real_name" => "required",
                "role"  => "required|integer",
                "tel" => "required|regex:/^1[3456789][0-9]{9}$/",
            ];
        }
        if($this->route()->uri() == "admin/adn/{adn}/edit"){
            $data = [
                "id"  => "required",
                "account" => "required|min:8|max:20|unique:admins,account",
                "password" => "max:20|confirmed",
                "password_confirmation" => "same:password",
                "real_name" => "required",
                "role"  => "required|integer",
                "tel" => "required|regex:/^1[3456789][0-9]{9}$/",
            ];
        }
        return $data;
    }

    public function messages()
    {
        return [
            "account.required" => "账号不可为空",
            "account.min" => "账号最少可输入8个字节",
            "account.max" => "账号最多可输入20个字节",
            "account.unique" => "账号已被申请",
            "password.required" => "密码不可以为空",
            "password.min" => "密码最少可输入8个字节",
            "password.max" => "密码最多可输入20个字节",
            "password_confirmation.required" => "确认密码不可为空",
            "password_confirmation.same" => "与密码不符，请检查",
            "real_name.required" => "真实姓名不可为空",
            "role.required" => "身份不可为空",
            "tel.required" => "电话不可为空",
            "tel.regex" => "电话号码不合法"
        ];
    }
}
