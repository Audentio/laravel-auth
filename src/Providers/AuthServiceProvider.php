<?php

namespace Audentio\LaravelAuth\Providers;

use Audentio\LaravelAuth\LaravelAuth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        LaravelAuth::routes();
    }
}