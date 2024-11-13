<?php

namespace App\Service;

use App\Repository\UserRepository;

class SecurityService
{
    private string $sessionKey = '';
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login(string $username, ?string $password): bool
    {
        $user = $this->repository->findOneByName($username);

        if (empty($user)) {
            return false;
        }

        if ($this->verifyPassword($password, $user['password'])) {
            $_SESSION[$this->sessionKey] = [
                'username' => $username,
                'logged_in' => true,
                'login_time' => time()
            ];
            return true;
        }

        return false;
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION[$this->sessionKey]['logged_in']) && $_SESSION[$this->sessionKey]['logged_in'] === true;
    }

    public function logout(): void
    {
        unset($_SESSION[$this->sessionKey]);
        session_destroy();
    }

    public function getUser(): ?array
    {
        return $_SESSION[$this->sessionKey] ?? null;
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword(string $password, string $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }

}