<?php

namespace Abbarbosa\infoDynamics\AutoRoute\Providers;

use Illuminate\Support\ServiceProvider;
use Abbarbosa\infoDynamics\Contracts\iAutoRouteModel;
use Abbarbosa\infoDynamics\AutoRoute\Model\AutoRouteModel;
use Abbarbosa\infoDynamics\Contracts\iAutoRouteService;
use Abbarbosa\infoDynamics\AutoRoute\Services\AutoRouteDbService;

class AutoRouteDbServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(iAutoRouteModel::class, AutoRouteModel::class);

        $this->app->bind(iAutoRouteService::class, AutoRouteDbService::class);

        $this->app->bind('autoRouteDB',
            function($app) {
            return new AutoRouteDbService(app(AutoRouteModel::class));
        });
    }
}