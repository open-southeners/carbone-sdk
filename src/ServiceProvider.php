<?php

namespace OpenSoutheners\CarboneSdk;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Carbone::class, function () {
            /** @var string $key */
            $key = config('services.carbone.key', env('CARBONE_API_KEY', ''));
            /** @var string|null $version */
            $version = config('services.carbone.version');

            return new Carbone($key, $version);
        });

        $this->app->alias(Carbone::class, 'carbone');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
