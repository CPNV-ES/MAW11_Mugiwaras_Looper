<?php

namespace App\Controllers;

use App\core\Renderer;
use App\models\Exercise;

class ResultsController extends baseController
{
    public function index(array $data): void
    {
        $exerciseTitle = $this->model->getExercise($data['exerciseId']);
        $answers = $this->model->getAnswersByExerciseId($data['exerciseId']);
        $uniqueFields = $this->getUniqueFields($answers);
        $answersByFulfillment = $this->groupAnswersByFulfillment($answers);

        Renderer::render("results", compact('uniqueFields', 'answersByFulfillment', 'exerciseTitle'));
    }

    public function show(array $params): void
    {
        $fieldId = $params['fieldId'];

        $answers = $this->model->getAnswersByFieldsId($fieldId);
        $exercise = $this->model->getExercise($params['exerciseId']);
        $exerciseTitle = $exercise[0]['title_exercise'];

        $data['answers'] = $answers;
        $data['exercise'] =  ['title' => $exerciseTitle, 'id' => $params['exerciseId']];

        Renderer::render("fieldResults", $data);

    }

    private function getUniqueFields(array $data): array
    {
        $uniqueFields = [];

        foreach ($data as $row) {
            $fieldLabel = $row['field_label'];
            $fieldId = $row['id_field'];

            // Check if the field label is not already in the $uniqueFields array
            if (!isset($uniqueFields[$fieldLabel])) {
                // Add the field label and field ID to the $uniqueFields array
                $uniqueFields[$fieldLabel] = [
                    'label' => $fieldLabel,
                    'id' => $fieldId,
                ];
            }
        }

        // Return only the values (without keys) to get a simple array
        return array_values($uniqueFields);
    }
        private function groupAnswersByFulfillment(array $data): array
    {
        $answersByFulfillment = [];

        foreach ($data as $row) {
            $fulfilled_at = $row['submited_at'];
            $field_label = $row['field_label'];
            $fulfillmentId = $row['id_fulfillment'];
            $answer = $row['answer'];

            // Check if the timestamp key exists
            if (!isset($answersByFulfillment[$fulfilled_at])) {
                $answersByFulfillment[$fulfilled_at] = [];
            }

            // Assign the answer to the corresponding timestamp and field label, along with fulfillment ID
            $answersByFulfillment[$fulfilled_at][$field_label]['answer'] = $answer;
            $answersByFulfillment[$fulfilled_at][$field_label]['fulfillmentId'] = $fulfillmentId;
        }

        return $answersByFulfillment;
    }
}
