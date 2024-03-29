<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Application\Dto\UserRegisterDto;
use PDO;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private PDO $dbh)
    {
    }

    /*
     * {@inheritDoc}
     */
    public function InsertUser(string $loginId, string $password, string $name): bool
    {
        $stmt = $this->dbh->prepare("INSERT INTO users (`login_id`, `password`, `name`) VALUES (?, ?, ?)");

        return $stmt->execute([$loginId, $password, $name]);
    }

    /*
     * {@inheritDoc}
     */
    public function getUser(string $loginId): UserRegisterDto|null
    {
        $stmt = $this->dbh->prepare("SELECT * FROM users WHERE `login_id` = ?");
        $stmt->execute([$loginId]);
        $user = $stmt->fetch();

        if ($user === false) {
            return null;
        }

        return new UserRegisterDto(
            $user['id'],
            $user['login_id'],
            $user['password'],
            $user['name']
        );
    }
}
