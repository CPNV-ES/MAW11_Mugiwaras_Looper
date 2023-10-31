<?php

namespace App\Controllers;

use App\core\Renderer;
use App\Model\Exercise;

class ExercisesController {

    public function __construct() {
        $this->model = new Exercise();
    }
    public function index(): void
    {
        Renderer::render("manageExercise");
    }
    public function answering(): void
    {
        // Call the function getAllExercises() in order to send the titles and ids of the exercises to the view
        $exercises = $this->model->getAllExercises();
        $data = ['exercises' => $exercises];
        Renderer::render("answering", $data);
    }
    public function new(): void
    {
        Renderer::render("createExercise");
    }
}
