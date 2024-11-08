<?php

namespace App;

class Router
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const DELETE = 'DELETE';

    private $routes = [];

    public function addRoute(string $method, string $path, object $controller, string $action): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action,
        ];
    }

    public function dispatch(string $uri, string $method): mixed
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper($method) && $route['path'] === $uri) {

                return call_user_func([$route['controller'], $route['action']]);
            }
        }

        return http_response_code(404);
    }

}