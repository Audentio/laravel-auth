<?php

namespace Audentio\LaravelAuth\Http\Controllers;

use Illuminate\Support\Facades\App;
use Laravel\Passport\Exceptions\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;

class AccessTokenController extends \Laravel\Passport\Http\Controllers\AccessTokenController
{
    use OAuthResponseHandlerTrait;
}