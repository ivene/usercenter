<?php
use Illuminate\Routing\Router;

$attributes = [
//    'prefix'     => config('admin.route.prefix'),
    'prefix'     => 'uc',
    'namespace'  => 'Ivene\UserCenter',
    'middleware' => ['web'],
];

Route::group($attributes, function ($router){
    $router->get('/login',"UserCenterController@login");
    $router->get('/user',"UserCenterController@user");
    $router->get('/reg',"UserCenterController@register");
    $router->get('/refresh',"UserCenterController@refresh");

});