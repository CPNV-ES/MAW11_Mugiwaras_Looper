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
        $label = $_POST['field']['label'] ?? '';
        $fieldKind = $_POST['field']['value_kind'] ?? '';
        $exercise = $this->model->getLastInsertedExercise();

        if(!empty($fieldKind)){
            $this->model->addField($label, $fieldKind, $exercise[0]['id_exercise']);
        }
        $fields = $this->model->getFields($exercise[0]['id_exercise']);

        $data = ["exercise" => $exercise[0], "fields" => $fields];
        Renderer::render("newFields",$data);
    }
}
