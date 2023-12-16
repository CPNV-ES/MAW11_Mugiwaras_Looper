<?php

namespace App\Controllers;

use App\core\Renderer;

class FulfillmentController extends baseController
{
    public function index(array $uriParams)
    {
        $exercise = $this->model->getExerciseById($uriParams['exerciseId']);
        $exerciseFullfillments = $this->model->getFulfillmentsByExerciseId($exercise[0]['id_exercise']);
        $data = ["exercise" => $exercise[0],"exerciseFullfillments" => $exerciseFullfillments];
        Renderer::render("exerciseFulfillments", $data);
    }
    public function new(array $uriParams): void
    {
        $exercise = $this->model->getExerciseById($uriParams['exerciseId']);
        $fields = $this->model->getFields($exercise[0]['id_exercise']);

        $data = ["exercise" => $exercise[0], "fields" => $fields];
        Renderer::render("fulfillments", $data);
    }
    public function create(array $data): void
    {
        $exerciseId = $data['exerciseId'] ?? '';
        $answers = $this->arrayCleanup($data);

        $fulfillmentId = $this->model->saveAnswers($exerciseId, $answers);
        header("Location: /exercises/" . $data['exerciseId'] . "/fulfillments/" . $fulfillmentId . "/edit");
    }
    public function update(array $data): void
    {
        $fulfillmentId = $data['fulfillmentId'] ?? '';
        $answers = $this->arrayCleanup($data);
        $this->model->updateAnswers($fulfillmentId, $answers);
        header("Location: /exercises/" . $data['exerciseId'] . "/fulfillments/" . $data['fulfillmentId'] . "/edit");
    }

    public function delete(array $uriParams): void
    {
        $this->model->deleteFulfillment($uriParams['fulfillmentId']);
        Renderer::render("dashboard");
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
    public function show(array $uriParams): void
    {
        $answers = $this->model->getAnswers($uriParams['fulfillmentId']);
        $fullfillment = $this->model->getFulfillment($uriParams['fulfillmentId']);
        $fields = $this->model->getFields($fullfillment[0]['id_exercise']);

        $data = ["answers" => $answers, "fulfillment" => $fullfillment[0], "fields" => $fields];

        Renderer::render("fulfillment", $data);
    }

    public function edit(array $uriParams): void
    {
        $exercise = $this->model->getExerciseById($uriParams['exerciseId']);
        $fields = $this->model->getFields($exercise[0]['id_exercise']);
        $answers = $this->model->getAnswersFromFulfillmentId($uriParams['fulfillmentId']);

        $data = ["exercise" => $exercise[0], "fields" => $fields, "answers" => $answers];
        Renderer::render("fulfillmentsEdit", $data);
    }
}