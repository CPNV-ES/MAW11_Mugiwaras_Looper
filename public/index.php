<?php

use App\core\Router;
use \Mugiwaras\Framework\Core\Route;

define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(APP_ROOT)->load();

$router = new \Mugiwaras\Framework\Core\Router([
    new Route("get", "/", "HomeController@index"),
    new Route("get", "/exercises", "ExercisesController@index"),
    new Route("put", "/exercises/{exerciseId}", "ExercisesController@updateStatus"),
    new Route('get', "/exercises/{id}/edit", "ExercisesController@fields"),
    new Route('get', "/exercises/{exerciseId}/results", "ExercisesController@showResults"),
    new Route("delete", "/exercises/{exerciseId}", "ExercisesController@deleteExercise"),

    new Route("get", "/exercises/new", "ExercisesController@new"),
    new Route("get", "/exercises/answering", "ExercisesController@answering"),
    new Route("post", "/exercises/create", "ExercisesController@create"),

    new Route("get", "/exercises/{exerciseId}/fields", "ExercisesController@fields"),
    new Route("post", "/exercises/{exerciseId}/fields", "ExercisesController@createField"),

    new Route("delete", "/exercises/{exerciseId}/fields/{fieldId}", "ExercisesController@deleteField"),
    new Route("post", "/exercises/{exerciseId}/fields/{fieldId}", "ExercisesController@updateField"),
    new Route("get", "/exercises/{exerciseId}/fields/{fieldId}/edit", "ExercisesController@editField"),
    new Route("delete", "/exercises/{exerciseId}/fields/{fieldId}", "ExercisesController@deleteField"),

    new Route("post", "/exercises/{exerciseId}/fulfillments", "ExercisesController@saveAnswers"),
    new Route("get", "/exercises/{exerciseId}/fulfillments/new", "ExercisesController@fulfillments"),
    new Route("get", "/exercises/{exerciseId}/fulfillments/{fulfillmentId}", "ExercisesController@fulfillment"),
    new Route("get", "/exercises/{exerciseId}/fulfillments/{fulfillmentId}/edit", "ExercisesController@fulfillmentsEdit"),
    new Route("post", "/exercises/{exerciseId}/fulfillments/{fulfillmentId}/edit", "ExercisesController@updateAnswers"),

    new Route("get", "/exercises/{exerciseId}/results", "ExercisesController@showResults"),
]);

$router->run();