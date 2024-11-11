<?php

namespace App\Controllers;

use App\Controller;

class AdminController extends Controller
{
    public function index(): string
    {
        if (!$this->auth->isLoggedIn()) {
            $this->redirectTo('/');
        }

        return $this->render('admin/index.twig');
    }
}