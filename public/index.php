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
    new Route('get', "/exercises/{id}/edit", "FieldsController@index"),
    new Route('get', "/exercises/{exerciseId}/results", "ResultsController@index"),
    new Route("delete","/exercises/{exerciseId}","ExercisesController@delete"),

    new Route("get", "/exercises/new", "ExercisesController@new"),
    new Route("get", "/exercises/answering", "AnswersController@index"),
    new Route("post", "/exercises/create", "ExercisesController@create"),

    new Route("get", "/exercises/{exerciseId}/fields", "FieldsController@index"),
    new Route("post", "/exercises/{exerciseId}/fields", "FieldsController@create"),

    new Route("post", "/exercises/{exerciseId}/fields/{fieldId}", "FieldsController@update"),
    new Route("get", "/exercises/{exerciseId}/fields/{fieldId}/edit", "FieldsController@edit"),
    new Route("delete", "/exercises/{exerciseId}/fields/{fieldId}", "FieldsController@delete"),

    new Route("post", "/exercises/{exerciseId}/fulfillments", "AnswersController@save"),
    new Route("get", "/exercises/{exerciseId}/fulfillments/new", "FulfillmentController@index"),
    new Route("get", "/exercises/{exerciseId}/fulfillments/{fulfillmentId}", "FulfillmentController@fulfillment"),
    new Route("get", "/exercises/{exerciseId}/fulfillments/{fulfillmentId}/edit", "FulfillmentController@edit"),
    new Route("post", "/exercises/{exerciseId}/fulfillments/{fulfillmentId}/edit", "AnswersController@update"),

    new Route("get","/exercises/{exerciseId}/results","ResultsController@index"),
    new Route("get", "/exercises/{exerciseId}/results/{fieldId}", "ResultsController@getResultsOfField"),
]);

$router->run();