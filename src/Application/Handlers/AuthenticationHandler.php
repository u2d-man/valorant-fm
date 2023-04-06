<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthenticationHandler
{
    const AUTH_KEY_FILE_PATH = '../../../hiding/ec256-public.pem';

    public function postAuthentication(Request $request, Response $response)
    {
        $authorizationHeader = $request->getHeader('Authorization');
        $reqJwt = preg_replace('/\ABearer /', '', $authorizationHeader[0]);

        $authKey = file_get_contents(self::AUTH_KEY_FILE_PATH);
        $claim = JWT::decode($reqJwt, $authKey);
    }
}
