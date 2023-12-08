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
        // Attempt to add the new exercise and get the ID
        $exerciseId = $this->model->addExercise($title);
        // Exercise creation succeeded, we redirect to the new exercise's page.
        header("Location: /exercises/$exerciseId/fields");
    }

    public function fields(array $uriParams): void
    {
        $exercise = $this->model->getExerciseById($uriParams['exerciseId']);
        $fields = $this->model->getFields($exercise[0]['id_exercise']);

        $data = ["exercise" => $exercise[0], "fields" => $fields];
        Renderer::render("newFields", $data);
    }

    public function createField(array $data): void
    {
        $label = $data['fieldLabel'] ?? '';
        $fieldKind = $data['fieldKind'] ?? '';

        $this->model->addField($label, $fieldKind, $data['exerciseId']);

        header("Location: /exercises/" . $data['exerciseId'] . "/fields");
    }

    public function deleteField(array $uriParams): void
    {
        $this->model->deleteField($uriParams['exerciseId'], $uriParams['fieldId']);
        header("Location: /exercises/" . $uriParams['exerciseId'] . "/fields");
    }

    public function editField(array $uriParams): void
    {
        $exercise = $this->model->getExerciseById($uriParams['exerciseId']);
        $field = $this->model->getFieldById($uriParams['fieldId']);

        $data = ["exercise" => $exercise[0], "field" => $field[0]];
        Renderer::render("editField", $data);
    }

    public function updateField(array $data): void
    {
        $label = $data['fieldLabel'] ?? '';
        $fieldKind = $data['fieldKind'] ?? '';

        $this->model->updateField($label, $fieldKind, $data['fieldId']);

        header("Location: /exercises/" . $data['exerciseId'] . "/fields");
    }

    public function updateStatus(array $data): void
    {
        $exerciseId = $data['exerciseId'] ?? '';
        $newStatus = $data['query']['status'] ?? '';
        $this->model->updateExerciseStatus($exerciseId, $newStatus);
        header("Location: /exercises");
    }
}
