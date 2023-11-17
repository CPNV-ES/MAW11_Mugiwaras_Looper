<?php

namespace App\core;

use App\controllers\ErrorController;

class Router
{
    public function dispatch($url): void
    {
        // Split the URL into segments removing slashes
        $segments = explode('/', trim($url, '/'));
        // Determine the controller based on the first segment
        $controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
        // Start looking for the action from the second segment
        $actionKey = 1;
        // Check if the second segment is numeric (assuming it's an ID), if so, skip it
        if (isset($segments[$actionKey]) && is_numeric($segments[$actionKey])) {
            $actionKey++;
        }
        // Determine the action to execute or give one by default
        $actionName = $segments[$actionKey] ?? 'index';
        // The remaining segments, if any, are treated as parameters for the action.
        $params = array_slice($segments, $actionKey + 1);
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
