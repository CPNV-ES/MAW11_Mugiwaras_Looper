<?php

namespace App\controllers;


class Dispatcher
{

    private $handlers = [];

    public function register($path, $handler)
    {
        $this->handlers[$path] = $handler;
    }

    public function dispatch($uri)
    {
        if (isset($this->handlers[$uri])) {
            $handlerClass = $this->handlers[$uri];
            $handlerInstance = new $handlerClass;
            return new Response($handlerInstance->handle());
        } else {
            return new Response("404 Not Found", 404);
        }
    }
}