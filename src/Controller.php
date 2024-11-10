<?php

namespace App;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    private Environment $twig;

    public function __construct()
    {
        // Initialize Twig loader and environment
        $loader = new FilesystemLoader(__DIR__ . '/templates');
        $this->twig = new Environment($loader);
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