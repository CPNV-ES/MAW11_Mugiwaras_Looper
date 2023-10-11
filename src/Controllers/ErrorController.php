<?php

namespace App\Controllers;

class ErrorController {
    public function notFound() {
        require APP_ROOT.'/src/views/error404.php';
    }
}