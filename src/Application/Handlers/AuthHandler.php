<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Services\AuthService;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;
use SlimSession\Helper as SessionHelper;
use Psr\Log\LoggerInterface;
use PDOException;

class AuthHandler
{

    const AUTH_KEY = '../hiding/ec256-private.pem';

    public function __construct(
        private AuthService     $authService,
        private SessionHelper   $session,
        private LoggerInterface $logger
    )
    {
    }

    public function auth(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $loginId = $body['login_id'];
        try {
            $userDto = $this->authService->getUser($loginId);
        } catch (PDOException $e) {
            $this->logger->error('db error:' . $e->errorInfo[2]);

            return $response->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
        }

        if (is_null($userDto)) {
            $response->getBody()->write('The entered id could not be found.');

            return $response->withStatus(StatusCodeInterface::STATUS_UNAUTHORIZED);
        }

        $isVerify = password_verify($body['password'], $userDto->getPassword());
        if (!$isVerify) {
            $newResponse = $response->withStatus(401);
            $newResponse->getBody()->write('you are not signed in');

            return $newResponse->withHeader('Content-Type', 'text/plain; charset=UTF-8');
        }

        $payload = [
            'iss' => 'http://localhost',
            'login_id' => $userDto->getLoginId(),
            'iat' => time(),
        ];
        $authKey = file_get_contents(self::AUTH_KEY);
        $jwt = JWT::encode($payload, $authKey, 'HS256');

        $responseBody = json_encode(['token' => $jwt]);
        $this->session->set('user_id', $loginId);
        $response->getBody()->write($responseBody);

        return $response->withHeader('Content-Type', 'application/json; charset=UTF-8');
    }
}
