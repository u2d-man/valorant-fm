<?php

declare(strict_types=1);

namespace App\Application\Repositories;

use App\Application\Dto\UserRegisterDto;
use PDO;

class UserRegisterRepo
{
    public function __construct(private PDO $dbh)
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
        $stmt = $this->dbh->prepare("INSERT INTO users (`login_id`, `password`, `name`) VALUES (?, ?, ?)");

        return $stmt->execute([$loginId, $password, $name]);
    }

    /**
     * @param string $loginId
     * 
     * @return UserRegisterDto|null
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
