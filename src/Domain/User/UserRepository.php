<?php

declare(strict_types=1);

namespace App\Domain\User;

use PDO;
use App\Domain\User\UserRepositoryInterface;
class UserRepository implements UserRepositoryInterface
{
    public function __construct(private PDO $dbh) {}

    /*
     * {@inheritDoc}
     */
    public function InsertUser(string $loginId, string $password, string $name): bool
    {
        $stmt = $this->dbh->prepare("INERT INTO `users` (`login_id`, `password`, `name`) VALUES (?, ?, ?)");

        return $stmt->execute([$loginId, $password, $name]);
    }
}
