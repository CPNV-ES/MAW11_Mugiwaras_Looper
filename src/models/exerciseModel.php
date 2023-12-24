<?php

namespace App\models;

use Mugiwaras\Framework\Core\QueryBuilder;
use Mugiwaras\Framework\Core\Model;

class exerciseModel extends Model
{
    public function getExerciseById($exerciseId): array
    {
        return $this->qb->table("exercises")->where("id_exercise", "=", $exerciseId)->get();
    }

    public function getAllExercisesAnswering(): array|false
    {
        return $this->qb->table("exercises")->where("status", "=", "Answering")->get(["id_exercise", "title_exercise"]);
    }

    public function getAllExercises(): array|false
    {
        return $this->qb->table("exercises")->where("status", "IS NOT NULL", null)->get(
            ["id_exercise", "title_exercise", "status"]
        );
    }

    public function addExercise(string $title): ?int
    {
        return $this->qb->table("exercises")->save(["title_exercise" => $title, "status" => "Building"]);
    }

    public function deleteExercise($exerciseId): void
    {
        $this->qb->table("exercises")->where("id_exercise", "=", $exerciseId)->delete();
    }

    public function getCategorizedExercises(): array
    {
        $allExercises = $this->getAllExercises();

        $categorizedExercises = [
            'Building' => [],
            'Answering' => [],
            'Closed' => []
        ];

        foreach ($allExercises as $exercise) {
            $categorizedExercises[$exercise['status']][] = $exercise;
        }
        return $categorizedExercises;
    }

    public function updateExerciseStatus($exerciseId, $newStatus): void
    {
        $this->qb->table("exercises")->where("id_exercise", "=", $exerciseId)->update(["status" => $newStatus]);
    }

    public function getExercise($exerciseId): array
    {
        return $this->qb->table("exercises")->where("id_exercise", "=", $exerciseId)->get();
    }
}
