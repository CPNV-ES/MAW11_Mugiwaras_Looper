<?php

namespace App\Controllers;

use App\core\Renderer;

class FulfillmentController extends baseController
{
    public function index()
    {
        //todo implement
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
    public function fulfillment(array $uriParams): void
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