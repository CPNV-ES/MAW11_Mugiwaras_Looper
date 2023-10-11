<?php

use App\core\Router;

define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(APP_ROOT)->load();

$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);
