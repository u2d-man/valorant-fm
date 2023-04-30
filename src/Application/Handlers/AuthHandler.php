<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Domain\User\UserRepositoryInterface;
use Fig\Http\Message\StatusCodeInterface;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use PDOException;

class AuthHandler
{

    const AUTH_KEY = '../hiding/ec256-public.pem';

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private LoggerInterface $logger
    ) {}

    public function auth(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $loginId = $body['login_id'];
        try {
            $userDto = $this->userRepository->getUser($loginId);
        } catch (PDOException $e) {
            $this->logger->error('db error:' . $e->errorInfo[2]);

            return $response->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
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

        $responsebody = json_encode(['token' => $jwt]);
        $response->getBody()->write($responsebody);

        return $response->withHeader('Content-Type', 'application/json; charset=UTF-8');
    }
}
