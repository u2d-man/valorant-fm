<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Domain\User\UserRepositoryInterface;
use Fig\Http\Message\StatusCodeInterface;
use PDOException;
use SlimSession\Helper as SessionHelper;
use Psr\Log\LoggerInterface;

class UserMeHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private SessionHelper $session,
        private LoggerInterface $logger
    ) {
    }

    public function getUserMe(Request $request, Response $response): Response
    {
        $loginId = $this->session->get('user_id');
        if (is_null($loginId)) {
            $response->getBody()->write('session expire or not signin');

            return $response->withStatus(StatusCodeInterface::STATUS_UNAUTHORIZED);
        }
        try {
            $user = $this->userRepository->getUser($loginId);
        } catch (PDOException $e) {
            $this->logger->error('db error: ' . $e->errorInfo[2]);

            return $response->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
        }

        if (is_null($user)) {
            $response->withStatus(StatusCodeInterface::STATUS_UNAUTHORIZED);
            $response->getBody()->write('you are not signed in');

            return $response->withHeader('Content-Type', 'text/plain; charset=UTF-8');
        }

        $responseBody = json_encode([
            'message' => 'success get me',
            'data' => [
                'user_id' => $loginId
            ]
        ]);
        $response->getBody()->write($responseBody);

        return $response->withHeader('Content-Type', 'application/json; charset=UTF-8');
    }
}
