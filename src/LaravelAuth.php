<?php

namespace Audentio\LaravelAuth;

use Audentio\LaravelAuth\Http\Middleware\InjectClientSecretForPasswordGrant;
use Audentio\LaravelAuth\Providers\AuthServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class LaravelAuth
{
    public static function routes()
    {
        Route::group([
            'prefix' => 'oauth',
            'namespace' => '\Audentio\LaravelAuth\Http\Controllers',
        ], function (Router $router) {
            Route::post('/token', 'AccessTokenController@issueToken')
                ->middleware(InjectClientSecretForPasswordGrant::class);

            Route::delete('/token', 'AccessTokenController@destroy');
        });
    }
}