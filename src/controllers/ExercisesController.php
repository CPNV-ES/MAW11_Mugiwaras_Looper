<?php

namespace App\controllers;

use App\core\Renderer;
use App\models\Exercise;
class ExercisesController {

    private Exercise $model;

    public function __construct() {
        $this->model = new Exercise();
    }
    public function index(): void
    {
        $categorizedExercises = $this->model->getCategorizedExercises();
        Renderer::render("manageExercise", ['categorizedExercises' => $categorizedExercises]);
    }
    public function answering(): void
    {
        // Call the function getAllExercises() in order to send the titles and ids of the exercises to the view
        $exercises = $this->model->getAllExercisesAnswering();
        $data = ['exercises' => $exercises];
        Renderer::render("answering", $data);
    }
    public function new(): void
    {
        Renderer::render("createExercise");
    }
    public function create(): void
    {
        // Get the title of the new exercise from the form
        $title = $_POST['exercise']['title'] ?? '';
        // Attempt to add the new exercise and get the ID
        $exerciseId = $this->model->addExercise($title);
        // Exercise creation succeeded, we redirect to the new exercise's page.
        header("Location: /exercises/$exerciseId/fields");
    }
    public function fields(): void
    {
        Renderer::render("newFields");
    }
    public function updateStatus(): void
    {
        $exerciseId = $_GET['id_exercise'] ?? null;
        $newStatus = $_GET['newStatus'] ?? null;

        if ($exerciseId && $newStatus) {
            $this->model->updateExerciseStatus($exerciseId, $newStatus);
            header("Location: /exercises");
        }
    }
}
