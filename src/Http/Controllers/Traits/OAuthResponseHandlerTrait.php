<?php

namespace Audentio\LaravelAuth\Http\Controllers\Traits;

use Audentio\LaravelBase\Foundation\Traits\ApiResponseHandlerTrait;
use Illuminate\Http\Response;

trait OAuthResponseHandlerTrait
{
    use ApiResponseHandlerTrait;

    public function handleOAuthResponse(Response $response)
    {
        $content = json_decode($response->getContent());
        $statusCode = $response->getStatusCode();

        switch ($statusCode) {
            case 200:
                return $this->success($content);
                break;
            case 401:
                return $this->invalidCredentials();
                break;
            case 400:
                return $this->invalidRequest($content->error_description . ' ' . $content->hint);
                break;
            default:
                return $this->error('ERR', $content, $statusCode);
        }
    }
}