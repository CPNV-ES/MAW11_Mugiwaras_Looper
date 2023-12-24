<?php

namespace App\controllers;

class ErrorController
{
    public function notFound(): void
    {
        require APP_ROOT . '/src/views/error404.php';
    }
}