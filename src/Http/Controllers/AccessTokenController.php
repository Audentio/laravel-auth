<?php

namespace Audentio\LaravelAuth\Http\Controllers;

use App\Core;
use Illuminate\Support\Facades\App;
use Laravel\Passport\Exceptions\OAuthServerException;
use Laravel\Passport\Token;
use Psr\Http\Message\ServerRequestInterface;

class AccessTokenController extends \Laravel\Passport\Http\Controllers\AccessTokenController
{
    use OAuthResponseHandlerTrait;

    public function destroy(\Request $request)
    {
        try {
            /** @var Token $token */
            $token = \Auth::user()->token();
        } catch (\Throwable $e) {
            return $this->unauthorized();
        }

        \DB::transaction(function() use ($token) {
            \DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $token->id)
                ->update(['revoked' => 1]);

            $token->revoke();
        });

        return $this->success([], 'This token has been revoked');
    }
}