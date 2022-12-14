<?php

namespace WebApp\Models;

use PDO;

Class DB
{
    public function getPDO()
    {
        $dsn = "mysql:host=mysql:3306;dbname=db;";
        $pdo = new PDO($dsn, 'db_docker', 'password');

        return $pdo;
    }

    public function insertTask(PDO $dbh, string $title, string $description)
    {
        $pdo = $dbh;

        $stmt = $pdo->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
        $stmt->execute([$title, $description]);
    }
}
