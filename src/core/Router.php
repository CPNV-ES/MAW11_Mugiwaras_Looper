<?php

namespace App\core;

use App\Controllers\ErrorController;


class Router {
    private array $routes = [];

    public function __construct() {
        $this->addDefaultRoutes();
    }

    private function addDefaultRoutes(): void
    {
        $this->addRoute('/', 'HomeController', 'index');
        $this->addRoute('/exercises', 'ExerciseController', 'index');
        $this->addRoute('/exercises/answering', 'ExerciseController', 'answering');
        $this->addRoute('/exercises/new', 'ExerciseController', 'new');
        $this->addRoute('/exercises/new/fulfillment', 'ExerciseController','fulfillment');
        $this->addRoute('/exercises', 'ExerciseController', 'manage');
        // Add more routes as needed...
    }
    public function addRoute($pattern, $controller, $action): void
    {
        $this->routes[$pattern] = ['controller' => $controller, 'action' => $action];
    }
    public function dispatch($url): void
    {
        foreach ($this->routes as $pattern => $route) {

            // Checking if the pattern matches the URL
            if (preg_match("~^$pattern$~", $url, $matches)) {
                array_shift($matches);

                // If there is a match, call the controller and action
                $controllerClass = "App\\Controllers\\" . $route['controller'];
                $controller = new $controllerClass();
                call_user_func_array([$controller, $route['action']], $matches);
                return;
            }
        }
        // If there is no match, call the error controller
        $errorController = new ErrorController();
        $errorController->notFound();
    }
}