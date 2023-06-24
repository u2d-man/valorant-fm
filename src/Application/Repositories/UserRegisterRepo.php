<?php

declare(strict_types=1);

namespace App\Application\Repositories;

use App\Domain\User\UserDto;
use PDO;

class UserRegisterRepo
{
    public function __construct(private PDO $dbh)
    {
    }

    /**
     * @param string $loginId
     * @param string $password
     * 
     * @return bool
     */
    public function InsertUser(string $loginId, string $password, string $name): bool
    {
        $stmt = $this->dbh->prepare("INSERT INTO users (`login_id`, `password`, `name`) VALUES (?, ?, ?)");

        return $stmt->execute([$loginId, $password, $name]);
    }


    /**
     * @param string $loginId
     * 
     * @return UserDto|null
     */
    public function getUser(string $loginId): UserDto|null
    {
        $stmt = $this->dbh->prepare("SELECT * FROM users WHERE `login_id` = ?");
        $stmt->execute([$loginId]);
        $user = $stmt->fetch();

        if ($user === false) {
            return null;
        }

        return new UserDto(
            $user['id'],
            $user['login_id'],
            $user['password'],
            $user['name']
        );
    }
}
