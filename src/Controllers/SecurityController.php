<?php
namespace App\Controllers;

use App\Auth;
use App\Controller;
use App\Service\SecurityService;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class SecurityController extends Controller
{
    public function index(): string
    {
        $error = '';

        if ($this->isSubmited()) {
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
            $auth = new SecurityService();
            $logged = $auth->login($username, $password);

            if ($logged) {
                return $this->render('security/index.twig', ['error' => $error]);
            }

            $error = 'Invalid credentials!';

        }

        return $this->render('security/index.twig', ['error' => $error]);
    }

}
