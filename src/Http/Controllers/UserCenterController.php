<?php

namespace Ivene\UserCenter;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\Input;

class UserCenterController
{
    use Result;
    protected $validation;
    protected $token;
    function __construct(ValidationFactory $validation,UcUserTokenRepository $token)
    {
        $this->validation = $validation;
        $this->token = $token;
    }

    public function login(){
        return UserCenter::login(Input::get('loginname'), Input::get('password'),Input::get('client_id'));
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     * @description 注册一个用户 返回用户信息和Token信息
     * @auther YaoYao
     */
    public function register(){
        if(empty(Input::get('loginname'))){
            return $this->error('账号不能为空');
        }
        $user  =  UcUser::where('loginname',Input::get('loginname'))->first();
        if(empty($user)){
            $user = (new UcUser())->fill(Input::all());
            $user->password = md5(Input::get('password'));
            $user->save();
            $t = $this->token->create($user->id,Input::get('clientid'));
            $t->user;
            return $this->success($t);
        }else{
            return  $this->error('账号已经存在');
        }
    }


    /**
     * @return mixed
     * @description 根据refresh_token 刷新用户Token
     * @auther YaoYao
     */
    public function refresh(){
        return  UserCenter::refresh(Input::get('refresh_token'),Input::get('client_id'));
    }

    /**
     * @return mixed
     * @description 根据 access_token 获取用户信息
     * @auther YaoYao
     */
    public function user(){
        return UserCenter::user(Input::get('access_token'),Input::get('client_id'));
    }
}
