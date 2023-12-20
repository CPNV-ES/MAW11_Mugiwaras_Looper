<?php

namespace App\controllers;

use App\core\Renderer;
use App\models\Exercise;

class ExercisesController extends baseController
{
    public function index(): void
    {
        $categorizedExercises = $this->model->getCategorizedExercises();
        $this->renderer->render("manageExercise", ['categorizedExercises' => $categorizedExercises]);

    }

    public function new(): void
    {
        $this->renderer->render("createExercise");
    }

    public function create(array $data): void
    {
        $title = $data['exerciseTitle'] ?? '';
        $exerciseId = $this->model->addExercise($title);
        header("Location: /exercises/$exerciseId/fields");
    }

    public function destroy(array $uriParams): void
    {
        $this->model->deleteExercise($uriParams['exerciseId']);
        header("Location: /exercises");
    }

    public function updateStatus(array $data): void
    {
        $exerciseId = $data['exerciseId'] ?? null;
        $newStatus = $data['query']['status'] ?? null;
        if ($exerciseId && $newStatus) {
            $this->model->updateExerciseStatus($exerciseId, $newStatus);
            header("Location: /exercises");
        }
    }
    public function answering(): void
    {
        $exercises = $this->model->getAllExercisesAnswering();
        $data = ['exercises' => $exercises];
        $this->renderer->render("answering", $data);
    }
}
