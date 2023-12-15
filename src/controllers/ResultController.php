<?php

namespace App\controllers;

use App\models\Exercise;
use App\core\Renderer;

class ResultController {


    private Exercise $model;

    public function __construct()
    {
        $this->model = new Exercise();
    }

    public function getResultsOfField(array $params): void
    {
        $fieldId = $params['fieldId'];
        
        $answers = $this->model->getAnswersByFieldsId($fieldId);
        $exercise = $this->model->getExercise($params['exerciseId']);
        $exerciseTitle = $exercise[0]['title_exercise'];

        $data['answers'] = $answers;
        $data['exercise'] =  ['title' => $exerciseTitle, 'id' => $params['exerciseId']];

        Renderer::render("fieldResults", $data);
        
    }

}