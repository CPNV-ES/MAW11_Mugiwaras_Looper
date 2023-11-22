<?php

use App\core\Router;
use \Mugiwaras\Framework\Core\Route;
define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(APP_ROOT)->load();

$router = new \Mugiwaras\Framework\Core\Router([
new Route("get","/","HomeController@index"),
new Route("get","/exercises","ExercisesController@manage"),
new Route("get","/exercises/new","ExercisesController@new"),
new Route("get","/exercises/answering","ExercisesController@answering"),

new Route("post","/exercises/create","ExercisesController@create"),
new Route("get","/exercises/{exerciseId}/fields","ExercisesController@fields"),
new Route("post","/exercises/{exerciseId}/fields","ExercisesController@createField"),
new Route("get","/exercises/{exerciseId}/fulfillments/new","ExercisesController@fulfillments"),

    ]);
$router->run();