<?php

namespace App\controllers;

use App\core\Renderer;
use App\models\exerciseModel;
use App\models\fieldModel;
use Mugiwaras\Framework\Core\Controller;
use Mugiwaras\Framework\Core\Model;

class ExercisesController extends controller
{
    private $exerciseModel;
    private $fieldModel;

    public function __construct()
    {
        parent::__construct();
        $this->exerciseModel = new exerciseModel();
        $this->fieldModel = new fieldModel();
    }

    public function index(): void
    {
        $categorizedExercises = $this->exerciseModel->getCategorizedExercises();
        $this->renderer->render("manageExercise", ['categorizedExercises' => $categorizedExercises]);
    }

    public function new(): void
    {
        $this->renderer->render("createExercise");
    }

    public function create(array $data): void
    {
        $title = $data['exerciseTitle'] ?? '';
        $exerciseId = $this->exerciseModel->addExercise($title);
        header("Location: /exercises/$exerciseId/fields");
    }

    public function destroy(array $uriParams): void
    {
        $this->exerciseModel->deleteExercise($uriParams['exerciseId']);
        header("Location: /exercises");
    }

    public function updateStatus(array $uriParams): void
    {
        $exerciseId = $uriParams['exerciseId'] ?? null;
        $fields = $this->fieldModel->getFields($exerciseId);
        $newStatus = $uriParams['query']['status'] ?? null;
        if (!$fields) {
            header("Location: /exercises/$exerciseId/fields");
        } else {
            $this->exerciseModel->updateExerciseStatus($exerciseId, $newStatus);
            header("Location: /exercises");
        }
    }

    public function answering(): void
    {
        $exercises = $this->exerciseModel->getAllExercisesAnswering();
        $data = ['exercises' => $exercises];
        $this->renderer->render("answering", $data);
    }
}
