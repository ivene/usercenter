<?php
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 2018/3/13
 * Time: 17:35
 */

namespace Ivene\UserCenter;

use Carbon\Carbon;

class UcCenter
{
    use Result;
    private $tokener;
    private $tokenRepository;
    function __construct()
    {
        $this->tokener = new Tokener();
        $this->tokenRepository =  new UcUserTokenRepository();
    }

    public function login($loginname,$passwd,$client_id){
        $user  = UcUser::where('loginname',$loginname)->first();
        if(!empty($user)){
            if(md5($passwd) ==  $user->password){
                $token  =  UcUserToken::where('user_id',$user->id)->where('client_id',$client_id)->first();
                if(empty($token)){
                    $token=$this->tokenRepository->create($user->id,$client_id);
                }
                return $this->success($token);
            }else{
                return $this->error('密码错误');
            }
        }else{
            return $this->error('登陆账号不存在');
        }
    }

    public function check($token,$uid,$clientid=1){
        $token  =  UcUserToken::where('access_token',$token)
            ->where('user_id',$uid)
            ->where('client_id',$clientid)
            ->first();
        return !empty($token);
    }
    public function token($uid,$clientid=1){
        $token = UcUserToken::where('user_id',$uid)
            ->where('client_id',$clientid)
            ->first();
        if(empty($token)){
            return "";
        }else{
            return $token->access_token;
        }
    }
    public function user($access_token,$clientid=1){
        $token = UcUserToken::where('access_token',$access_token)
            ->where('client_id',$clientid)
            ->first();
        if(!empty($token)){
            $token->user;
            return $this->success($token);
        }else{
            return $this->error('Token不存在');
        }
    }
    public function refresh($refresh_token,$clientid=1){
        $token = UcUserToken::where('refresh_token',$refresh_token)
            ->where('client_id',$clientid)
            ->first();;
        if(empty($token)){
            return $this->error('参数异常');
        }
        $token->access_token = $this->tokener->make($token->user_id,$clientid);
        $token->refresh_token = $this->tokener->make($token->user_id,$clientid,'refreshToken');
        $token->expires_at =  Carbon::now()->addDay(60);
        $token->save();
        return $this->success($token);
    }
}