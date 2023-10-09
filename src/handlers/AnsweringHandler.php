<?php

namespace App\Handlers;

use App\Controllers\ExerciseController;
use App\core\Renderer;

class AnsweringHandler {

    private $renderer;
    private $exerciseController;

    public function __construct() {
        $this->renderer = new Renderer(__DIR__ . '\..\views');
        $this->exerciseController = new ExerciseController();
    }

}
