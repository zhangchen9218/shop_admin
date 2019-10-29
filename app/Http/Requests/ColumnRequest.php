<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColumnRequest extends CommonRequest
{

    /**
     * Get the validation rules that apply to the request.
     * inta
     * @return array
     */
    public function rules()
    {
        return [
            "pid" => "required|integer",
            "level" => "integer",
            "name" => "required|min:2|max:10",
            "cotegory_id" => [
                "required",
                "integer",
                Rule::in(CATEGORY_IDS)
            ],
            "selectable" => "boolean",
        ];
    }

    public function messages()
    {
        return [
            "pid.required" => "请选择父类标签，如没有父类请选择顶级标签",
            "pid.integer"  => "请选择有效父类",
            "level.integer"  => "请选择有效分类等级",
            "name.required" => "请输入栏目名称",
            "name.min" => "分类名称不能少于两个字",
            "name.max" => "分类名称不能大于10个字",
            "selectable.boolean" => "请进行有效操作",
            "index_page.mimes" => "请选择有效首页",
            "list_page.mimes" => "请选择有效列表页",
            "show_page.mimes" => "请选择有效详情页",
        ];
    }

}
