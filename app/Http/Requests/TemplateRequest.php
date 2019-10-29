<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateRequest extends CommonRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "type" => "integer",
            "name" => "required"
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "模板名称必须填写"
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if(empty($this->file('template'))){
                $validator->errors()->add('template', '请上传模板文件');
            }
        });
    }
}
