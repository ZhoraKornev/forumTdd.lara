<?php

namespace App\Providers;

use App\Channel;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use View as ViewRoot;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()){
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ViewRoot::composer('*', function ($view) {
            $channels = \Cache::remember('channels',60*60*24,function (){
                return Channel::all();
            }) ;
            /** @var View $view */
            $view->with('channels', $channels);
        });
    }
}
