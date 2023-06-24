<?php

declare(strict_types=1);

namespace App\Application\Services;

use App\Application\Repositories\UserRegisterRepo;

class UserRegisterService
{
    public function __construct(private UserRegisterRepo $userRegisterRepo)
    {
    }

    /**
     * @param string $loginId
     * @param string $password
     * @param string $name
     * 
     * @return bool
     */
    public function insertUser(string $loginId, string $password, string $name): bool
    {
        return $this->userRegisterRepo->insertUser($loginId, $password, $name);
    }
}
