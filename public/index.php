<?php
require_once '../src/Router.php';
require_once '../src/controllers/SecurityController.php';

use App\Controllers\SecurityController;
use App\Router;

$router = new Router();

// Define routes
$router->addRoute(Router::GET, '/', new SecurityController(), 'index');

// Dispatch request based on the current URI and request method
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);