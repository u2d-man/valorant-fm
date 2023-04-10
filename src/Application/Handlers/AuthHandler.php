<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Domain\User\UserRepositoryInterface;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthHandler
{

    const AUTH_KEY = '../hiding/ec256-public.pem';

    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function auth(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $loginId = $body['login_id'];
        $user = $this->userRepository->getUser($loginId);
        $isVerify = password_verify($body['password'], $user[0]['password']);

        if (!$isVerify) {
            $newResponse = $response->withStatus(401);
            $newResponse->getBody()->write('you are not signed in');

            return $newResponse->withHeader('Content-Type', 'text/plain; charset=UTF-8');
        }

        $payload = [
            'iss' => 'http://localhost',
            'login_id' => $user[0]['login_id'],
            'iat' => time(),
        ];
        $authKey = file_get_contents(self::AUTH_KEY);
        $jwt = JWT::encode($payload, $authKey, 'HS256');

        $responsebody = json_encode(['token' => $jwt]);
        $response->getBody()->write($responsebody);

        return $response->withHeader('Content-Type', 'application/json; charset=UTF-8');
    }
}
