<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\HelloService;
use App\Http\Services\HelloService2;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {




        //$this->app->bind(Hello::class,'App\Http\Services\HelloService');

        //use無しでおk。makeで呼び出すならこれで。
        //$this->app->bind('HelloService', function(){
    
        //use必須。コンストラクタインジェクションではこっち
        $this->app->bind(HelloService::class, function(){
    
            $class = new \App\Http\Services\HelloService();
            $class->foo = 'bar';
            return $class;
        });

        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
