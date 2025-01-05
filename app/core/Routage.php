<?php

namespace App\Core;

class Router
{
    private $routes = [];

    // Enregistre une route
    public function add($route, $controller)
    {
        $this->routes[$route] = $controller;
    }

    // Redirige la requête vers le bon contrôleur
    public function dispatch()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');

        // Vérifier si la route existe
        if (isset($this->routes[$url])) {
            $controllerName = $this->routes[$url];
            $this->callController($controllerName);
        } else {
            echo "Page not found!";
        }
    }

    // Appelle le contrôleur et la méthode appropriée
    private function callController($controllerName)
    {
        $controllerClass = "App\\Controllers\\" . $controllerName;
        $controller = new $controllerClass();

        $method = $_SERVER['REQUEST_METHOD'] === 'POST' ? 'post' : 'get';
        
        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            echo "Method not allowed!";
        }
    }
}
