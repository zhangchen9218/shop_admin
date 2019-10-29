<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;


class ArticleRequest extends CommonRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|min:5|max:50",
            "column_id" => [
                    "required",
                    Rule::exists("columns","id")->where('state',1)
            ],
            "category_id" => [
                    "required",
                    Rule::exists("categories","id")->where('state',1)
            ],
            "key_words" => "required|max:100",
            "intro"  => "required|max:200",
            "author" => "required",
            "source" => "required",
            "editor" => "required",
            "state"  => [
                "required",
                Rule::in([1,2]),
            ],
        ];
    }

    public function messages()
    {
        return [
            "column_id.exists" => "所选的栏目不存在",
            "category_id.exists" => "所选分类不存在",
            "state.in" => "请不要随意修改状态值",
            "state.required" => "请不要随意修改状态值",
        ];
    }


}
