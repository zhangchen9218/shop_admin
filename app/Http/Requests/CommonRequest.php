<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
class CommonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->session()->has("admin_id")){
            return true;
        }
        return false;
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
        ];
    }

    // 重写ajax请求验证错误响应格式（防止验证422报错）
    protected function failedValidation(Validator $validator)
    {
        // 此处自定义您想要返回的数据类型
        $data = [
            'code' => CODE_FAIL,
            'msg' => $validator->errors(),
        ];
        $respone = new Response(json_encode($data));

        throw (new ValidationException($validator, $respone))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
