<?php

use App\core\Router;

define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(APP_ROOT)->load();

(new \App\core\Router())->dispatch($_SERVER['REQUEST_URI']);
