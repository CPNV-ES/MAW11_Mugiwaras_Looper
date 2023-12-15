<?php

namespace App\Controllers;

use App\core\Renderer;
use App\models\Exercise;

class ResultsController extends baseController
{
    public function index(array $data): void
    {
        $exerciseTitle = $this->model->getExercise($data['exerciseId']);
        $data = $this->model->getAnswersByExerciseId($data['exerciseId']);
        $uniqueFields = $this->getUniqueFields($data);
        $answersByFulfillment = $this->groupAnswersByFulfillment($data);

        Renderer::render("results", compact('uniqueFields', 'answersByFulfillment', 'exerciseTitle'));
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
