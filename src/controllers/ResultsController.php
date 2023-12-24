<?php

namespace App\Controllers;

use App\core\Renderer;
use App\models\AnswerModel;
use App\models\exerciseModel;
use App\models\fieldModel;
use App\models\fulfillmentModel;
use Mugiwaras\Framework\Core\Controller;

class ResultsController extends controller
{
    private exerciseModel $exerciseModel;
    private answerModel $answerModel;

    public function __construct()
    {
        parent::__construct();

        $this->exerciseModel = new exerciseModel();
        $this->answerModel = new answerModel();
    }

    public function index(array $data): void
    {
        $exercise = $this->exerciseModel->getExercise($data['exerciseId']);
        $answers = $this->answerModel->getAnswersByExerciseId($data['exerciseId']);
        $uniqueFields = $this->getUniqueFields($answers);
        $answersByFulfillment = $this->groupAnswersByFulfillment($answers);

        $this->renderer->render("results", compact('uniqueFields', 'answersByFulfillment', 'exercise'));
    }

    public function show(array $params): void
    {
        $fieldId = $params['fieldId'];
        $answers = $this->answerModel->getAnswersByFieldsId($fieldId);
        $exercise = $this->exerciseModel->getExercise($params['exerciseId']);

        $this->renderer->render("fieldResults", compact('exercise', 'answers'));
    }

    private function getUniqueFields(array $data): array
    {
        $uniqueFields = [];

        foreach ($data as $row) {
            $fieldLabel = $row['field_label'];
            $fieldId = $row['id_field'];

            // Check if the fieldModel label is not already in the $uniqueFields array
            if (!isset($uniqueFields[$fieldLabel])) {
                // Add the fieldModel label and fieldModel ID to the $uniqueFields array
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

            // Assign the answer to the corresponding timestamp and fieldModel label, along with fulfillmentModel ID
            $answersByFulfillment[$fulfilled_at][$field_label]['answer'] = $answer;
            $answersByFulfillment[$fulfilled_at][$field_label]['fulfillmentId'] = $fulfillmentId;
        }

        return $answersByFulfillment;
    }
}
