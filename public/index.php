<?php

use App\core\Route;

define('APP_ROOT', dirname(__DIR__));

require_once APP_ROOT . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(APP_ROOT);
$dotenv->load();

$route = new Route();
$router = $route->getRouter();

