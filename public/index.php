<?php

use App\core\Router;
use \Mugiwaras\Framework\Core\Route;

define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(APP_ROOT)->load();

$router = new \Mugiwaras\Framework\Core\Router([
    new Route("get", "/", "DashboardController@index"),

    new Route("get", "/exercises", "ExercisesController@index"),
    new Route("post", "/exercises", "ExercisesController@create"),

    new Route("get", "/exercises/new", "ExercisesController@new"),
    new Route("get", "/exercises/answering", "ExercisesController@answering"),

    new Route("put", "/exercises/{exerciseId}", "ExercisesController@updateStatus"),
    new Route("delete","/exercises/{exerciseId}","ExercisesController@destroy"),

    new Route('get', "/exercises/{exerciseId}/results", "ResultsController@index"),

    new Route("get", "/exercises/{exerciseId}/fields", "FieldsController@index"),
    new Route("post", "/exercises/{exerciseId}/fields", "FieldsController@create"),
    new Route("post", "/exercises/{exerciseId}/fields/{fieldId}", "FieldsController@update"),
    new Route("get", "/exercises/{exerciseId}/fields/{fieldId}/edit", "FieldsController@edit"),
    new Route("delete", "/exercises/{exerciseId}/fields/{fieldId}", "FieldsController@delete"),

    new Route("get", "/exercises/{exerciseId}/fulfillments", "FulfillmentController@index"),
    new Route("post", "/exercises/{exerciseId}/fulfillments", "FulfillmentController@create"),
    new Route("get", "/exercises/{exerciseId}/fulfillments/new", "FulfillmentController@new"),
    new Route("get", "/exercises/{exerciseId}/fulfillments/{fulfillmentId}", "FulfillmentController@show"),
    new Route("post", "/exercises/{exerciseId}/fulfillments/{fulfillmentId}", "FulfillmentController@update"),
    new Route("delete", "/exercises/{exerciseId}/fulfillments/{fulfillmentId}", "FulfillmentController@delete"),
    new Route("get", "/exercises/{exerciseId}/fulfillments/{fulfillmentId}/edit", "FulfillmentController@edit"),

    new Route("get","/exercises/{exerciseId}/results","ResultsController@index"),
    new Route("get", "/exercises/{exerciseId}/results/{fieldId}", "ResultsController@show"),
]);

$router->run();
