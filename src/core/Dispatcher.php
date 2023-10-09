<?php

namespace App\core;


class Dispatcher
{

    private $handlers = [];

    // Register a handler for a given path
    public function register($path, $handler)
    {
        $this->handlers[$path] = $handler;
    }

    // Dispatch a request to the appropriate handler
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