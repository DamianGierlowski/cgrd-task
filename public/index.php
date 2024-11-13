<?php
require_once '../src/Router.php';
require_once '../src/Controller.php';
require_once '../src/Database.php';
require_once '../src/Repository.php';
require_once '../src/controllers/SecurityController.php';
require_once '../src/controllers/AdminController.php';
require_once '../src/Service/SecurityService.php';
require_once '../src/Repository/NewsRepository.php';
require_once '../src/Repository/UserRepository.php';
require_once '../vendor/autoload.php';

use App\Controllers\AdminController;
use App\Controllers\SecurityController;
use App\Router;

$router = new Router();


// Define routes
$router->addRoute(Router::GET, '/', new SecurityController(), 'index');
$router->addRoute(Router::GET, '/logout', new SecurityController(), 'logout');
$router->addRoute(Router::POST, '/', new SecurityController(), 'index');
$router->addRoute(Router::POST, '/', new SecurityController(), 'index');

$router->addRoute(Router::GET, '/admin', new AdminController(), 'index');
$router->addRoute(Router::GET, '/admin/news', new AdminController(), 'news');
$router->addRoute(Router::POST, '/admin/create', new AdminController(), 'create');
$router->addRoute(Router::POST, '/admin/delete', new AdminController(), 'delete');
$router->addRoute(Router::POST, '/admin/update', new AdminController(), 'update');

// Dispatch request based on the current URI
echo $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);