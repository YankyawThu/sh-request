<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share([
            'success' => function(){
                if(Session::get('success')){
                    return Session::get('success');
                }
                else return false;
            },
            'error' => function(){
                if($error = Session::get('errors')){
                    return $error->getBag('default');
                }
                else return false;
            },
            'fail' => function() {
                if(Session::get('fail')){
                    return Session::get('fail');
                }
                else return false;
            },
            'data' => function() {
                if(Session::get('data')){
                    return Session::get('data');
                }
                else return false;
            },
        ]);
    }
}
