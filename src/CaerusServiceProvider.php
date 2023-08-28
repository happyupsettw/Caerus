<?php
namespace Panigale\Caerus;

use Illuminate\Support\ServiceProvider;

class CaerusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('caerus' ,function(){
            return new Caerus();
        }) ;
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('caerus' ,function(){
            return new Caerus();
        }) ;
    }
}
