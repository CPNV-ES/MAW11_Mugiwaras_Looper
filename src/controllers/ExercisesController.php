<?php

namespace App\controllers;

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

    public function manage(): void
    {
        Renderer::render("manageExercise");
    }
    public function create() {
        // Get the title of the new exercise from the form
        $title = $_POST['exercise']['title'] ?? '';
        // Attempt to add the new exercise and get the ID
        $exerciseId = $this->model->addExercise($title);
        // Exercise creation succeeded, we redirect to the new exercise's page.
        header("Location: /exercises/$exerciseId/fields");
        exit;
    }
    public function newFields(): void
    {
        Renderer::render("newFields");
    }
}
