<?php

namespace Audentio\LaravelAuth\Providers;

use Audentio\LaravelAuth\LaravelAuth;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    protected static bool $shouldRunMigrations;

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }

        LaravelAuth::routes();
    }

    protected function registerMigrations()
    {
        if (!isset(self::$shouldRunMigrations)) {
            self::$shouldRunMigrations = Passport::$runsMigrations;
        }

        if (self::$shouldRunMigrations) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
            Passport::ignoreMigrations();
        }
    }
}
