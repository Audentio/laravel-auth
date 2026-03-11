<?php

namespace Audentio\LaravelAuth\Providers;

use Audentio\LaravelAuth\LaravelAuth;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    protected static bool $shouldRunMigrations = true;

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }

        if (!LaravelAuth::shouldSkipRoutes()) {
            LaravelAuth::routes();
        }
    }

    protected function registerMigrations()
    {
        if (self::$shouldRunMigrations) {
            if (method_exists(Passport::class, 'ignoreMigrations')) {
                Passport::ignoreMigrations();
            }
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }
    }
}
