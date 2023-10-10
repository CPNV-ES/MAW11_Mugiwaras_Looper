<?php

namespace App\core;

class Route {

    private $router;

    public function __construct() {
        $this->router = new Router();

        // Define the routes
        $this->addRoutes();
    }

    private function addRoutes() {
        // Other routes...
        $this->router->addRoute('/', 'HomeController', 'index');
        $this->router->addRoute('/exercises', 'ExerciseController', 'index');
        $this->router->addRoute('/exercises/answering', 'ExerciseController', 'answering');
        // Add more routes as needed...
    }

    public function getRouter() {
        return $this->router;
    }
}
