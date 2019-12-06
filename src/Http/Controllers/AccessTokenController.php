<?php

namespace Audentio\LaravelAuth\Http\Controllers;

use Illuminate\Support\Facades\App;
use Laravel\Passport\Exceptions\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;

class AccessTokenController extends \Laravel\Passport\Http\Controllers\AccessTokenController
{
    use OAuthResponseHandlerTrait;

    public function issueToken(ServerRequestInterface $request)
    {
        try {
            $oAuthResponse = parent::issueToken($request);
        } catch (OAuthServerException $e) {
            $response = $e->render(request());
            return $this->handleOAuthResponse($response);
        }

        dump($oAuthResponse);die;

        return $this->handleOAuthResponse($response);
    }
}