<?php

namespace OpenSoutheners\CarboneSdk;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(Carbone::class, function (): Carbone {
            /** @var string $key */
            $key = config('services.carbone.key', env('CARBONE_API_KEY', ''));
            /** @var string|null $version */
            $version = config('services.carbone.version');

            return new Carbone($key, $version);
        });

        $this->app->alias(Carbone::class, 'carbone');

        $this->registerAboutCommandInfo();
    }

    /**
     * Register the `php artisan about` command integration.
     */
    protected function registerAboutCommandInfo(): void
    {
        // The about command is only available in Laravel 9 and up so we need to check if it's available to us
        if (! class_exists(AboutCommand::class)) {
            // @codeCoverageIgnoreStart
            return;
            // @codeCoverageIgnoreEnd
        }

        AboutCommand::add('Integrations', [
            'Carbone' => config('services.carbone.key', env('CARBONE_API_KEY', '')) ? '' : '',
        ]);
    }
}
