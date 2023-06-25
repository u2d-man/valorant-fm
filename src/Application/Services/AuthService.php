<?php

namespace App\Application\Services;

use App\Application\Repositories\UserRegisterRepo;
use App\Application\Dto\UserRegisterDto;

class AuthService
{
    public function __construct(private UserRegisterRepo $userRegisterRepo)
    {
    }

    /**
     * @param string $loginId
     *
     * @return UserRegisterDto|null
     */
    public function getUser(string $loginId): ?UserRegisterDto
    {
        return $this->userRegisterRepo->getUser($loginId);
    }
}
