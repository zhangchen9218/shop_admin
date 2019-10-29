<?php

namespace App\Http\Requests;


class RoleRequest extends CommonRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "请输入名称"
        ];
    }
}
