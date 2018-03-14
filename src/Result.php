<?php
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 2018/3/14
 * Time: 11:27
 */

namespace Ivene\UserCenter;

trait Result
{
    private function respond($data)
    {
        return response()->json($data);
    }
    public function error($msg,$code="20000"){
        return $this->respond(['code'=>$code,'msg'=>$msg]);
    }
    public function success($data,$msg="操作成功",$code="10000"){
        return $this->respond(['code'=>$code,'msg'=>$msg,'data'=>$data]);
    }

}