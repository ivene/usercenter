<?php

namespace Ivene\UserCenter;

use Illuminate\Support\ServiceProvider;

class UserCenterProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadRoutesFrom(__DIR__."/routes.php");
        $this->loadMigrationsFrom(__DIR__."/../database/migrations");
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('uc',function(){
            return new UcCenter();
        });
    }
}
