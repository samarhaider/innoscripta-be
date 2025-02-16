<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Factories\NewsServiceFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(NewsServiceFactory::class, function ($app) {
            return new NewsServiceFactory($app);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
