<?php

namespace Audentio\LaravelAuth\Providers;

use Audentio\LaravelAuth\LaravelAuth;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }

        LaravelAuth::routes();
    }

    protected function registerMigrations()
    {
        if (Passport::$runsMigrations) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
            Passport::ignoreMigrations();
        }
    }
}