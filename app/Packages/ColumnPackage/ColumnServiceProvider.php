<?php

namespace App\Packages\ColumnPackage;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class ColumnServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::singleton("column",function(){
            return new Column();
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
