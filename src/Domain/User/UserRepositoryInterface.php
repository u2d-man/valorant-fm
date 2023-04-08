<?php

declare(strict_types=1);

namespace App\Domain\User;

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
}
