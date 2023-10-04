<?php


// Load dependencies
require '../vendor/autoload.php';

const BASE_DIR = __DIR__;

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();


// Set up routing
$dispatcher = new \App\controllers\Dispatcher();

// Register a handler for exercises answering
$dispatcher->register('/exercises/answering', \App\Handlers\AnsweringHandler::class);

// Handle the incoming request
$dispatcher->dispatch($_SERVER['REQUEST_URI']);

$response = $dispatcher->dispatch($_SERVER['REQUEST_URI']);
$response->send();

