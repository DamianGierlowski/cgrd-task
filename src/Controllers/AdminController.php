<?php

namespace App\Controllers;

use App\Controller;
use App\Repository\NewsRepository;
use Throwable;

class AdminController extends Controller
{
    public function index(): string
    {
        if (!$this->auth->isLoggedIn()) {
            $this->redirectTo('/');
        }

        return $this->render('admin/index.twig');
    }

    public function news(): string
    {
        $repository = new NewsRepository();
        $news = $repository->findAll();

        return json_encode($news);
    }

    public function create()
    {
        header('Content-Type: application/json');
        try {
            $title = $_POST['title'] ?? null;
            $content = $_POST['content'] ?? null;
            $repository = new NewsRepository();
            $repository->create($title, $content);

            return json_encode(['success' => true, 'message' => 'Article created successfully']);
        } catch (Throwable $throwable) {
            return json_encode(['success' => false, 'message' => 'An error occurred. Could not complete the action.']);
        }
    }

    public function delete(): string
    {
       header('Content-Type: application/json');
       try {
           $id = $_POST['id'];
           $repository = new NewsRepository();
           $repository->delete($id);

           return json_encode(['success' => true, 'message' => 'Article removed successfully']);
       } catch (Throwable $throwable) {
           return json_encode(['success' => false, 'message' => 'An error occurred. Could not complete the action.']);
       }
    }

    public function update(): string
    {
        header('Content-Type: application/json');
        try {
            $id = $_POST['id'];
            $title = $_POST['title'] ?? null;
            $content = $_POST['content'] ?? null;
            $repository = new NewsRepository();
            $repository->update($id, $title, $content);

            return json_encode(['success' => true, 'message' => 'Article updated successfully']);
        } catch (Throwable $throwable) {
            return json_encode(['success' => false, 'message' => 'An error occurred. Could not complete the action.']);
        }
    }

}