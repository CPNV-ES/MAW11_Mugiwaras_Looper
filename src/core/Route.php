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
        $this->router->addRoute('/', 'HomeController', 'index');
        $this->router->addRoute('/exercises', 'ExerciseController', 'index');
        $this->router->addRoute('/exercises/answering', 'ExerciseController', 'answering');
    }

    public function getRouter() {
        return $this->router;
    }
}
