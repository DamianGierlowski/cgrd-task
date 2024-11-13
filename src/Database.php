<?php

namespace App;

use PDO;
use PDOException;

class Database
{
    private string $host = 'db';
    private string $db = 'news_db';
    private string $user = 'root';
    private string $pass = 'password';
    private string $charset = 'utf8mb4';

    private ?PDO $pdo = null;

    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    public function getConnection(): ?PDO
    {
        return $this->pdo;
    }

    public function closeConnection(): void
    {
        $this->pdo = null;
    }

}