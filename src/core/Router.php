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
            if (preg_match("~^$pattern$~", $url, $matches)) {
                array_shift($matches);
                $controllerClass = "App\\Controllers\\" . $route['controller'];
                $controller = new $controllerClass();
                call_user_func_array([$controller, $route['action']], $matches);
                return;
            }
        }

        $errorController = new ErrorController();
        $errorController->notFound();
    }
}