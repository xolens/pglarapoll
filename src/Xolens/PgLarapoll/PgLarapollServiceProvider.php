<?php

namespace Xolens\PgLarapoll;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Xolens\PgLarautil\PgLarautilServiceProvider;

class PgLarapollServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->register(PgLarautilServiceProvider::class);

        $this->publishes([
            __DIR__.'/../../config/xolens-pglarapoll.php' => config_path('xolens-pglarapoll.php'),
        ]);
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/xolens-pglarapoll.php', 'xolens-pglarapoll'
        );
    }
}