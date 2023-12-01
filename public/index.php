<?php

<<<<<<< Updated upstream
use App\core\Router;
use \Mugiwaras\Framework\Core\Route;
=======
use \Mugiwaras\Framework\Core\Route;

>>>>>>> Stashed changes
define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(APP_ROOT)->load();

<<<<<<< Updated upstream
$router = new \Mugiwaras\Framework\Core\Router([
new Route("get","/","HomeController@index"),
new Route("get","/exercises","ExercisesController@index"),
new Route("get","/exercises/new","ExercisesController@new"),
new Route("get","/exercises/answering","ExercisesController@answering"),

new Route("post","/exercises/create","ExercisesController@create"),
new Route("get","/exercises/{exerciseId}/fields","ExercisesController@fields"),
new Route("post","/exercises/{exerciseId}/fields","ExercisesController@createField"),
new Route("get","/exercises/{exerciseId}/fulfillments/new","ExercisesController@fulfillments"),

    ]);
$router->run();
=======

//$router = new Router();
$router = new \Mugiwaras\Framework\Core\Router([
    new Route('GET', '/', "HomeController@index"),
    new Route('GET', '/exercises', "ExercisesController@index"),
    new Route('GET', '/exercises/{id}/edit', "ExercisesController@fields"),
    new Route('GET', '/exercises/{id}/results', "ExercisesController@showResults"),
]);

$url = $_SERVER['REQUEST_URI'];

$requestMethod = $_SERVER['REQUEST_METHOD'];

$router->run();
//$router->dispatch($url, $requestMethod);
>>>>>>> Stashed changes
