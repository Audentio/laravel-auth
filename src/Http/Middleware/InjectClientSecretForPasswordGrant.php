<?php

namespace Audentio\LaravelAuth\Http\Middleware;

use Illuminate\Http\Request;

class InjectClientSecretForPasswordGrant
{
    public function handle(Request $request, \Closure $next)
    {
        $input = $request->all();


        if (empty($input['client_secret']) && !empty($input['token_type'])
            && $input['token_type'] == 'front_auth' && !empty($input['grant_type'])
            && ($input['grant_type'] == 'password' || $input['grant_type'] == 'refresh_token')) {
            $input['client_id'] = env('OAUTH_FRONT_CLIENT_ID');
            $input['client_secret'] = env('OAUTH_FRONT_CLIENT_SECRET');
            $request->replace($input);
        }

        return $next($request);
    }
}