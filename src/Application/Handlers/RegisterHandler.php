<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Domain\User\UserRepositoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RegisterHandler
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function postRegister(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $password = password_hash($body['password'], PASSWORD_DEFAULT);

        $_ = $this->userRepository->InsertUser($body['login_id'], $password, $body['name']);

        $responseBody = json_encode(['message' => 'success user created']);
        $response->getBody()->write($responseBody);

        return $response->withHeader('Content-Type', 'application/json; charset=UTF-8');
    }
}
