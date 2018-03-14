<?php
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 2018/3/13
 * Time: 19:12
 */

namespace Ivene\UserCenter;


use Carbon\Carbon;

class UcUserTokenRepository
{
    use Result;

    private $tokener;
    function __construct()
    {
        $this->tokener =  new Tokener();
    }

    public function create($userId,$clientid){
        $token  = (new UcUserToken())->fill([
            'user_id'=>$userId,
            'client_id'=>$clientid,
            'access_token' => $this->tokener->make($userId,$clientid),
            'refresh_token' =>  $this->tokener->make($userId,$clientid,'RefreshToken'),
            'expires_at' => Carbon::now()->addDay(100),
        ]);
        $token->save();
        return $token;
    }
    public function find($access_token,$clientid){
        $token = UcUserToken::where('access_token',$access_token)
            ->where('client_id',$clientid)
            ->first();
        if(empty($token)){
           return  $this->error('access_token 不存在');
        }else{
            $token->user;
            return $this->success($token);
        }
    }
}