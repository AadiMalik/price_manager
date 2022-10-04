<?php

namespace App\Providers;

use App\SiteContent;
use App\Notification;
use Illuminate\Support\ServiceProvider;

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
        // $this->loadFrom();


//        Send Data in all laravel blade files
        $siteContents = SiteContent::all();
        $notification = Notification::all();
        view()->share('siteContents', $siteContents);
        view()->share('notification', $notification);

    }
}
