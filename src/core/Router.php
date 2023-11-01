<?php

namespace App\core;

use App\controllers\ErrorController;

class Router {
     public function dispatch($url): void
    {
        // Split the URL into segments removing slashes
        $segments = explode('/', trim($url, '/'));
        // Determine the controller based on the segments or giving a default controller
        $controllerName = isset($segments[0]) && $segments[0] ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
        // Determine the action to execute from the controller or give one by default
        $actionName = isset($segments[1]) && $segments[1] ? $segments[1] : 'index';
        // The remaining segments, if any, are treated as parameters for the action.
        $params = array_slice($segments, 2);
        // Check if the controller and the method exist
        $controllerClass = "App\\Controllers\\" . $controllerName;
        // Checking and creating the controller and call the action
        if (class_exists($controllerClass) && method_exists($controllerClass, $actionName)) {
            $controller = new $controllerClass();
            call_user_func_array([$controller, $actionName], $params);
        } else {
            // If there is no matching controller or action, call the error controller
            $errorController = new ErrorController();
            $errorController->notFound();
        }
    }
}
