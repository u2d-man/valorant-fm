<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Application\Dto\UserRegisterDto;

interface UserRepositoryInterface
{
    /**
     * @param string $loginId
     * @param string $password
     * @param string $name
     *
     * @return bool
     */
    public function InsertUser(string $loginId, string $password, string $name): bool;

    /**
     * @param string $loginId
     *
     * @return UserRegisterDto|null
     */
    public function getUser(string $loginId): UserRegisterDto|null;
}
