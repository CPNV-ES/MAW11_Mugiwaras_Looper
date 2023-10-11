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

        // Call the function getAllExercises() in order to send the titles and ids of the exercises to the view
        $exercises = $this->model->getAllExercises();
        $data = ['exercises' => $exercises];
        Renderer::render("answering", $data);
    }
    public function new() {
        Renderer::render("createExercise");
    }
    public function manage() {
        Renderer::render("manageExercise");
    }
}
