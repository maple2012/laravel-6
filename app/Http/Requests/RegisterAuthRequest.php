<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Validators\Validator;


class RegisterAuthRequest extends FormRequest
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
            'name' => 'required|string',
            'phone' => 'required|unique:users',
            'password' => 'required|string|min:6|max:10'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名必须填写',
            'name.string' => '用户名必须为字符串',
            'phone.required' => '手机号必须填写',
            'phone.unique' => '该手机号已被注册',
            'password.required' => '密码必须填写',
            'password.string' => '密码不能为特殊字符',
            'password.min' => '密码低于 6 位',
            'password.max' => '密码超过 10 为',
        ];
    }
    protected function formatValidationErrors(Validator $validator)
    {
        $message = $validator->errors()->all();
        return ['message'=>$message, 'status_code' => 500];
    }


}
