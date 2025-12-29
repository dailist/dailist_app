<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Push visitor tracking middleware into the web middleware group
        if ($this->app->bound('router')) {
            /** @var Router $router */
            $router = $this->app->make('router');
            $router->pushMiddlewareToGroup('web', \App\Http\Middleware\TrackVisits::class);
        }
    }
}
