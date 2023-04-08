<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Domain\User\UserRepositoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RegisterHandler
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function postRegister(Request $request, Response $response): bool
    {
        $loginId = $request->getHeader('login_id');
        $password = $request->getHeader('password');
        $name = $request->getHeader('name');
        $password = password_hash($password[0], PASSWORD_DEFAULT);

        return $this->userRepository->InsertUser($loginId[0], $password[0], $name[0]);
    }
}
