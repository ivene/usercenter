<?php
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 2018/3/13
 * Time: 17:35
 */

namespace Ivene\UserCenter;


use Illuminate\Database\Eloquent\Model;

class UcUserToken extends Model
{
    protected $table = 'uc_user_token';
    public $timestamps = true;
    protected $fillable=[
        'user_id',
        'client_id',
        'access_token',
        'refresh_token',
        'expires_at'
    ];
    protected $dates = [
        'expires_at',
    ];
    protected $hidden=['created_at','updated_at','id'];
    public function user(){
        return $this->hasOne(UcUser::class,'id','user_id');
    }
}