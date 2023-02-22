<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class HelloServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    
    public function register()
    {
        /*
        $this->app->bind('Hello',function($app){
            return new HelloService();
        });
        */
        $this->app->bind('Hello::class','App\Http\Services\HelloService');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //第1引数：コンポーザを割り当てるビュー
        //第2引数：実行するクロージャ、関数など
        /*
        View::composer(
            'section', function($view){
                $view->with('view_message', 'composer message!');
            }
        );
        */
        View::composer(
            'section', 'App\Http\Composers\HelloComposer'
        );
    }
}
