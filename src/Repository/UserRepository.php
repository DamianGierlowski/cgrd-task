<?php

namespace App\Repository;

use App\Repository;

class UserRepository extends Repository
{
    public function findOneByName(string $name): array
    {
        $stmt = $this->getPdo()->prepare("SELECT * FROM users where login = (?)");
        $stmt->execute([$name]);

        return current($stmt->fetchAll());
    }
}