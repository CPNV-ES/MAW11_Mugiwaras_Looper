<?php

namespace App\core;

use App\Controllers\ErrorController;


class Router {
    private $routes = [];

    public function addRoute($pattern, $controller, $action) {
        $this->routes[$pattern] = ['controller' => $controller, 'action' => $action];
    }

    public function dispatch($url) {
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