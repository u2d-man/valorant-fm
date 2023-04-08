<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Domain\User\UserRepositoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthHandler
{

    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function auth(Request $request, Response $response): Response
    {
        $headerAuthorization = $request->getHeader('Authorization');

        $result = $this->userRepository->getUser();

        return $response;
    }
}
