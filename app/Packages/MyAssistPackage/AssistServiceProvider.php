<?php

namespace App\Packages\MyAssistPackage;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AssistServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::singleton("assist",function(){
            return new Assist();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
