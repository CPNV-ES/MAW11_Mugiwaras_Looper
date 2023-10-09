<?php

use App\core\Dispatcher;
use App\Handlers\AnsweringHandler;


// Load dependencies with Composer
require_once '../vendor/autoload.php';


// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();


// Set up routing
$dispatcher = new Dispatcher();

// Register a handler for exercises answering
$dispatcher->register('/exercises/answering', AnsweringHandler::class);

// Handle the incoming request
$dispatcher->dispatch($_SERVER['REQUEST_URI']);

// Send the response request
$response = $dispatcher->dispatch($_SERVER['REQUEST_URI']);
$response->send();

