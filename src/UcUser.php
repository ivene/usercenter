<?php
namespace Ivene\UserCenter;


use Illuminate\Database\Eloquent\Model;

class UcUser extends Model
{
    protected $table = 'uc_user';
    public $timestamps = true;
    protected $fillable=[
        'uname',
        'loginname',
        'iphone',
        'email',
        'img',
        'ustatus',
        'salt'
    ];

    protected $hidden=['password','salt','updated_at'];
}