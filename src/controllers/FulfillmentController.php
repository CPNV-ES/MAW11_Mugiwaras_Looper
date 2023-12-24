<?php

namespace App\Controllers;

use App\core\Renderer;
use App\models\AnswerModel;
use App\models\exerciseModel;
use App\models\fieldModel;
use App\models\fulfillmentModel;
use Mugiwaras\Framework\Core\Controller;

class FulfillmentController extends controller
{
    private fieldModel $fieldModel;
    private exerciseModel $exerciseModel;
    private fulfillmentModel $fulfillmentModel;
    private answerModel $answerModel;

    public function __construct()
    {
        parent::__construct();

        $this->fulfillmentModel = new fulfillmentModel();
        $this->fieldModel = new fieldModel();
        $this->exerciseModel = new exerciseModel();
        $this->answerModel = new answerModel();
    }

    public function index(array $uriParams)
    {
        $exercise = $this->exerciseModel->getExerciseById($uriParams['exerciseId']);
        $exerciseFullfillments = $this->fulfillmentModel->getFulfillmentsByExerciseId($exercise[0]['id_exercise']);

        $data = ["exercise" => $exercise[0], "exerciseFullfillments" => $exerciseFullfillments];
        $this->renderer->render("exerciseFulfillments", $data);
    }

    public function new(array $uriParams): void
    {
        $exercise = $this->exerciseModel->getExerciseById($uriParams['exerciseId']);
        $fields = $this->fieldModel->getFields($exercise[0]['id_exercise']);

        $data = ["exercise" => $exercise[0], "fields" => $fields];
        $this->renderer->render("fulfillments", $data);
    }

    public function create(array $data): void
    {
        $exerciseId = $data['exerciseId'] ?? '';
        $answers = $this->arrayCleanup($data);

        $fulfillmentId = $this->answerModel->saveAnswers($exerciseId, $answers);
        header("Location: /exercises/" . $data['exerciseId'] . "/fulfillments/" . $fulfillmentId . "/edit");
    }

    public function update(array $data): void
    {
        $fulfillmentId = $data['fulfillmentId'] ?? '';
        $answers = $this->arrayCleanup($data);
        $this->answerModel->updateAnswers($fulfillmentId, $answers);
        header("Location: /exercises/" . $data['exerciseId'] . "/fulfillments/" . $data['fulfillmentId'] . "/edit");
    }

    public function delete(array $uriParams): void
    {
        $this->fulfillmentModel->deleteFulfillment($uriParams['fulfillmentId']);
        header("Location: /");
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
        $exercise = $this->exerciseModel->getExerciseById($uriParams['exerciseId']);
        $answers = $this->answerModel->getAnswers($uriParams['fulfillmentId']);
        $fulfillment = $this->fulfillmentModel->getFulfillment($uriParams['fulfillmentId']);
        $fields = $this->fieldModel->getFields($fulfillment[0]['id_exercise']);

        $data = [
            "exercise" => $exercise,
            "answers" => $answers,
            "fulfillment" => $fulfillment[0],
            "fields" => $fields
        ];

        $this->renderer->render("fulfillment", $data);
    }

    public function edit(array $uriParams): void
    {
        $exercise = $this->exerciseModel->getExerciseById($uriParams['exerciseId']);
        $fields = $this->fieldModel->getFields($exercise[0]['id_exercise']);
        $answers = $this->answerModel->getAnswersFromFulfillmentId($uriParams['fulfillmentId']);

        $data = ["exercise" => $exercise[0], "fields" => $fields, "answers" => $answers];
        $this->renderer->render("fulfillmentsEdit", $data);
    }
}