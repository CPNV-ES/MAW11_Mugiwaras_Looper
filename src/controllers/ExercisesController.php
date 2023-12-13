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
        $title = $data['exerciseTitle'] ?? '';
        $exerciseId = $this->model->addExercise($title);
        header("Location: /exercises/$exerciseId/fields");
    }

    public function fields(array $uriParams)
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

    public function fulfillments(array $uriParams): void
    {
        $exercise = $this->model->getExerciseById($uriParams['exerciseId']);
        $fields = $this->model->getFields($exercise[0]['id_exercise']);

        $data = ["exercise" => $exercise[0], "fields" => $fields];
        Renderer::render("fulfillments", $data);
    }

    public function fulfillment(array $uriParams): void
    {
        $answers = $this->model->getAnswers($uriParams['fulfillmentId']);
        $fullfillment = $this->model->getFulfillment($uriParams['fulfillmentId']);
        $fields = $this->model->getFields($fullfillment[0]['id_exercise']);

        $data = ["answers" => $answers, "fulfillment" => $fullfillment[0], "fields" => $fields];

        Renderer::render("fulfillment", $data);
    }

    public function fulfillmentsEdit(array $uriParams): void
    {
        $exercise = $this->model->getExerciseById($uriParams['exerciseId']);
        $fields = $this->model->getFields($exercise[0]['id_exercise']);
        $answers = $this->model->getAnswersFromFulfillmentId($uriParams['fulfillmentId']);

        $data = ["exercise" => $exercise[0], "fields" => $fields, "answers" => $answers];

        Renderer::render("fulfillmentsEdit", $data);
    }

    public function saveAnswers(array $data): void
    {
        $exerciseId = $data['exerciseId'] ?? '';
        $answers = $this->arrayCleanup($data);

        $fulfillmentId = $this->model->saveAnswers($exerciseId, $answers);
        header("Location: /exercises/" . $data['exerciseId'] . "/fulfillments/" . $fulfillmentId . "/edit");
    }

    private function arrayCleanup(array $dirtyArray): array
    {
        $cleanArray = [];

        foreach ($dirtyArray as $key => $value) {
            if (strpos($key, 'answer_') === 0) {
                $splitedData = explode('answer_', $key);
                $cleanArray[$splitedData[1]] = $value;
            }
        }
        return $cleanArray;
    }

    public function deleteExercise(array $uriParams): void
    {
        $this->model->deleteExercise($uriParams['exerciseId']);
        header("Location: /exercises");
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
        $exerciseId = $_GET['id_exercise'] ?? null;
        $newStatus = $_GET['newStatus'] ?? null;
        if ($exerciseId && $newStatus) {
            $this->model->updateExerciseStatus($exerciseId, $newStatus);
            header("Location: /exercises");
        }
    }

    public function showResults(array $data): void
    {
        $exerciseId = $data['exerciseId'];
        $data = $this->model->getAnswersByExerciseId($exerciseId);
        $uniqueFields = $this->getUniqueFields($data);
        $answersByFulfillment = $this->groupAnswersByFulfillment($data);
        Renderer::render("results", compact('uniqueFields', 'answersByFulfillment'));
    }

    private function getUniqueFields(array $data): array
    {
        return array_unique(array_column($data, 'field_label'));
    }

    private function groupAnswersByFulfillment(array $data): array
    {
        $answersByFulfillment = [];

        foreach ($data as $row) {
            $fulfilled_at = $row['submited_at'];
            $field_label = $row['field_label'];
            $answer = $row['answer'];
            $answersByFulfillment[$fulfilled_at][$field_label] = $answer;
        }
        return $answersByFulfillment;
    }
}
