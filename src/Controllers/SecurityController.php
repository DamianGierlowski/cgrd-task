<?php
namespace App\Controllers;

use App\Controller;
use App\Service\SecurityService;

class SecurityController extends Controller
{
    public function index(): string
    {
        if ($this->isSubmited()) {
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
            $logged = $this->auth->login($username, $password);

            if ($logged) {
                $this->redirectTo('/admin');
            }
            $error = 'Invalid credentials!';
        }

        return $this->render('security/index.twig', ['error' => $error ?? '']);
    }

    public function logout(): void
    {
        $this->auth->logout();

        $this->redirectTo('/');
    }

}
