<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       Blade::if('hasroles',function($expression){
            if(Auth::user()){
                if(Auth::user()->hasroles($expression)){
                    return true;

                }
            }
            return false;
       });
       blade::if('impersonate',function(){
           if(session()->get('impersonate')){
               return true;
           }
           return false;
       });
    }
}
