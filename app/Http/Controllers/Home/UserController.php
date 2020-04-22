<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\JWTAuth;

class UserController extends Controller
{
    /**
     * @Describe
     * @param Request $request
     * @return mixed
     */
    public function  register(Request $request) {
        $newUser = [
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password'))
        ];

        $user = User::create($newUser);
        $token = JWTAuth::fromUser($user);
        return responseSuccess($token);
    }

    /**
     * @Describe
     * @param UserLoginRequest $request
     * @return \Illuminate\Auth\Access\Response
     */
    public function authorize(UserLoginRequest $request) {
        $credentials = $request->only('email','password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return responseError(-1, "邮箱或者密码错误");
            }
        } catch (JWTException $e) {
            return responseError(-3, "token 无法生成");
        }

        return responseSuccess(compact('token'));

    }

    public function logout()
    {
        JWTAuth::setToken(JWTAuth::getToken())->invalidate();

        return responseSuccess();
    }


}
