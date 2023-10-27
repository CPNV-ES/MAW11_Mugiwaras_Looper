<?php

namespace App\Controllers;

use App\core\Renderer;
use App\Model\Exercise;

class ExerciseController {

    public function __construct() {
        $this->model = new Exercise();
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['exercise']['title'];

            // Add the new exercise and get the ID
            $exerciseId = $this->model->addExercise($title);

            if ($exerciseId) {
                // Redirect to the newly created exercise page
                header("Location: /exercises/$exerciseId/fields");
                exit;
            } else {
                // Handle the case where exercise creation failed
                // You might want to display an error message
            }
        } else {
            Renderer::render("newFields");
        }
    }
}
