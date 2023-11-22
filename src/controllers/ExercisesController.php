<?php

namespace App\controllers;

use App\core\Renderer;
use App\models\Exercise;

class ExercisesController
{

    private Exercise $model;

    public function __construct()
    {
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

    public function create(array $data): void
    {
        // Get the title of the new exercise from the form
        $title = $data['exerciseTitle'] ?? '';
        var_dump($data);
        die();
        // Attempt to add the new exercise and get the ID
        $exerciseId = $this->model->addExercise($title);
        // Exercise creation succeeded, we redirect to the new exercise's page.
        header("Location: /exercises/$exerciseId/fields");

    }

    private function fieldsOld()
    {
        $label = $_POST['field']['label'] ?? '';
        $fieldKind = $_POST['field']['value_kind'] ?? '';
        $exercise = $this->model->getLastInsertedExercise();

        if(!empty($fieldKind)){
            $this->model->addField($label, $fieldKind, $exercise[0]['id_exercise']);
        }
        $fields = $this->model->getFields($exercise[0]['id_exercise']);

        return ["exercise" => $exercise[0], "fields" => $fields];
    }
    public function createFieldsOld(): void{
        $data = $this->fields();
        Renderer::render("newFields", $data);
    }

    public function fulfillmentsOld(): void{
        $data = $this->fields();
        Renderer::render("fulfillments", $data);
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
