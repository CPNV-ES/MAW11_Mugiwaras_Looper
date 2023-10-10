<?php

namespace App\Controllers;

use App\core\Renderer;
use App\Model\Exercise;

class ExerciseController {
    private $exerciseModel;

    public function __construct() {

        $this->model = new Exercise();
    }
    public function answering() {
        $exercises = $this->model->getAllExercisesTitle();
        $data =['exercises' => $exercises];
        Renderer::render("answering", $data);
    }
    public function new() {
        Renderer::render("createExercise");
    }
}
