<?php

namespace App\Http\Requests;

use App\Admin;
use App\Power;
use App\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class LoginCheckRequest extends FormRequest
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
            "account" => "required|min:8|max:20",
            "password" => "required|min:8|max:20",
            "captcha" => "required|captcha"
        ];
    }

    public function messages()
    {
            return [
                "captcha.captcha" => "验证码错误"
            ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $account = $this->input("account");
            $password = $this->input("password");

            //通过账号获取用户信息
            $adminInfo = Admin::where("account","=", $account)->first();

            if($adminInfo && Hash::check($password,$adminInfo->password)){
                $aInfo["admin_id"] = $adminInfo->id;
                $aInfo["admin_name"] = $adminInfo->real_name;

                $role = Role::find($adminInfo->role);
                $aInfo["role_name"] = $role->name;

                $powerIds = explode(",",$role->power_ids);
                $powerRes = Power::whereIn("id",$powerIds)->pluck("field")->toArray();
                $powerRes = explode(",",implode(",",$powerRes));
                $aInfo["role_powers"] = $powerRes;

                session($aInfo);
            }else {
                $validator->errors()->add('password', '用户名或密码错误');
            }
        });
    }
}
