<?php

namespace App\Http\Requests;


class CategoryRequest extends CommonRequest
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
            "name.required" => "请输入分类名称"
        ];
    }

}
