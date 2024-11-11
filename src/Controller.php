<?php

namespace App;

use App\Service\SecurityService;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    private Environment $twig;
    protected SecurityService $auth;

    public function __construct()
    {
        // Initialize Twig loader and environment
        $loader = new FilesystemLoader(__DIR__ . '/templates');
        $this->twig = new Environment($loader);
        $this->auth = new SecurityService();
    }

    public function redirectTo(string $uri): void
    {
        header("Location: $uri");
        exit;
    }

    public function render(string $file, array $parameters = []): string
    {
        return  $this->twig->render($file, $parameters);
    }

    public function isSubmited(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']);
    }
}