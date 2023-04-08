<?php

declare(strict_types=1);

namespace App\Domain\User;

use PDO;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private PDO $dbh) {}

    /*
     * {@inheritDoc}
     */
    public function InsertUser(string $loginId, string $password, string $name): bool
    {
        $stmt = $this->dbh->prepare("INSERT INTO users (`login_id`, `password`, `name`) VALUES (?, ?, ?)");

        return $stmt->execute([$loginId, $password, $name]);
    }
}
