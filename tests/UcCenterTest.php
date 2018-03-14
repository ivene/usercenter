<?php
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 2018/3/14
 * Time: 14:51
 */


use PHPUnit\Framework\TestCase;
class UcCenterTest extends  TestCase
{
    protected  $uc;
    public function setUp(){
        $this->uc = new Ivene\UserCenter\UcCenter();
    }
    public function testCheck(){
        $this->assertEquals(true,$this->uc->check('a112129a9a34915c15caa54cb160a79d',2));
    }
}