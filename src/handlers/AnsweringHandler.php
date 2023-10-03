<?php

namespace App\Handlers;

use App\Renderer\Renderer;
use App\controllers\exercises\ExerciseController;

class AnsweringHandler {

    private $renderer;
    private $exerciseController;

    public function __construct() {
        $this->renderer = new Renderer(__DIR__ . '\..\views');
        $this->exerciseController = new ExerciseController();
    }

    public function handle() {
        $menuItems = $this->exerciseController->getExercisesForView();
        return $this->renderer->render('answering', ['exercises' => $menuItems]);
    }
}
