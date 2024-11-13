<?php

namespace App;

use PDO;

class Repository
{
    protected Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getPdo(): PDO
    {
        return $this->database->getConnection();
    }

}