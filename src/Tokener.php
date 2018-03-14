<?php
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 2018/3/14
 * Time: 14:16
 */

namespace Ivene\UserCenter;


class Tokener
{
    public function make($user_id,$client_id,$option='accessToken' ){
      return  md5($user_id.$client_id.time().md5('ivene'.$option));
    }
}