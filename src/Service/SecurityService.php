<?php

namespace App\Service;

class SecurityService
{
    private string $sessionKey = '';

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login(?string $username, ?string $password): bool
    {
        $validUsername = 'admin'; //TODO
        $validPassword = 'test';//TODO

        if ($username === $validUsername && $password === $validPassword) {
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

}