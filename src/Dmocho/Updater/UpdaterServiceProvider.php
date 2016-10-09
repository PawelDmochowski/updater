<?php

namespace Dmocho\Updater;

use Illuminate\Support\ServiceProvider;

class UpdaterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/updater.php' => config_path('updater.php')
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/updater.php', 'updater');
    }
}
