<?php

namespace Bickyraj\Toc;

use Illuminate\Support\ServiceProvider;

class TocServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('contents', function () {
            return new Contents;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'toc');
        $this->publishes([
            __DIR__ . '/views' => resource_path('views/bickyraj'),
        ]);
    }
}
