<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Services\UserRegisterService;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use PDOException;

// user register
class UserRegisterHandler
{
    public function __construct(
        private UserRegisterService $userRegisterService,
        private LoggerInterface $logger
    ) {
    }

    public function postRegister(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        if (!array_key_exists('login_id', $body) || !array_key_exists('password', $body)) {
            $this->logger->error('password or login_id is empty.');
            $response->getBody()->write('forbidden');

            return $response->withStatus(StatusCodeInterface::STATUS_FORBIDDEN)
                ->withHeader('Content-Type', 'text/plain; charset=UTF-8');
        }
        $password = password_hash($body['password'], PASSWORD_DEFAULT);

        try {
            $_ = $this->userRegisterService->insertUser($body['login_id'], $password, $body['login_id']);
        } catch (PDOException $e) {
            $this->logger->error('db error:' . $e->errorInfo[2]);

            return $response->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
        }

        $responseBody = json_encode(['message' => 'success user created']);
        $response->getBody()->write($responseBody);

        return $response->withHeader('Content-Type', 'application/json; charset=UTF-8');
    }
}
