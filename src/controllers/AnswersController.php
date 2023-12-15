<?php

namespace App\Controllers;

use App\core\Renderer;

class AnswersController extends baseController
{
    public function save(array $data): void
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
}