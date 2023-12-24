<?php

namespace App\models;

use Mugiwaras\Framework\Core\QueryBuilder;

class Exercise
{
    private QueryBuilder $qb;

    function __construct()
    {
        $this->qb = QueryBuilder::getInstance();
    }

    public function getLastInsertedExercise(): array
    {
        return $this->qb->table("exercises")->desc("id_exercise")->limit(1)->get();
    }
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
        return $this->qb->table("exercises")->where("status", "IS NOT NULL", null)->get(["id_exercise", "title_exercise", "status"]);
    }

    public function getAnswersFromFulfillmentId(mixed $fulfillmentId): false|array
    {
        return $this->qb->table("answers")->where("id_fulfillment", "=", $fulfillmentId)->get();
    }

    public function addExercise(string $title): ?int
    {
        return $this->qb->table("exercises")->save(["title_exercise" => $title, "status" => "Building"]);
    }

    public function addFulfillment($exerciseId): false|string
    {
        return $this->qb->table("fulfillments")->save(["id_exercise" => $exerciseId]);
    }

    public function getFieldById($fieldId)
    {
        return $this->qb->table("fields")->where("id_field", "=", $fieldId)->get();
    }

    public function deleteField($fieldId)
    {
        $this->qb->table("fields")->where("id_field", "=", $fieldId)->delete();
    }

    public function addField($label, $fieldKind, $exercise)
    {
        return $this->qb->table("fields")->save(["label" => $label, "value_kind" => $fieldKind, "id_exercise" => $exercise]);
    }

    public function updateField($label, $fieldKind, $fieldId): void
    {
        $this->qb->table("fields")->where("id_field", "=", $fieldId)->update(["label" => $label, "value_kind" => $fieldKind]);
    }

    public function getFields($exerciseId): false|array
    {
        return $this->qb->table("fields")->where("id_exercise", "=", $exerciseId)->get(["id_field", "label", "value_kind"]);
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

        // Categorize exercises based on their status
        foreach ($allExercises as $exercise) {
            $categorizedExercises[$exercise['status']][] = $exercise;
        }
        return $categorizedExercises;
    }

    public function updateExerciseStatus($exerciseId, $newStatus): void
    {
        $this->qb->table("exercises")->where("id_exercise", "=", $exerciseId)->update(["status" => $newStatus]);
    }

    public function saveAnswers(mixed $exerciseId, array $answers)
    {
        $fulfillmentId = $this->addFulfillment($exerciseId);
        foreach ($answers as $idField => $value) {
            $this->qb->table("answers")->save(["id_field" => $idField, "id_fulfillment" => $fulfillmentId, "answer" => $value]);
        }
        return $fulfillmentId;
    }
    public function getExercise($exerciseId): array
    {
        return $this->qb->table("exercises")->where("id_exercise", "=", $exerciseId)->get();
    }

    public function getAnswers($fulfillmentId)
    {
        return $this->qb->table("answers")->where("id_fulfillment", "=", $fulfillmentId)->get();
    }

    public function getAnswersByExerciseId($exerciseId): array
    {
        return $this->qb->table("answers AS a")->join("fields AS f", "a.id_field", "f.id_field")->join("fulfillments AS ful", "a.id_fulfillment", "ful.id_fulfillment")->where("f.id_exercise", "=", $exerciseId)->get(["a.*, f.label AS field_label, ful.submited_at, f.id_exercise"]);
    }

    public function getAnswersByFieldsId(int $fieldId): array
    {
        return $this->qb->table("answers AS a")->join("fields AS f", "a.id_field", "f.id_field")->join("fulfillments AS ful", "a.id_fulfillment", "ful.id_fulfillment")->where("a.id_field", "=", $fieldId)->get(["a.*, f.label AS field_label, ful.submited_at, f.id_exercise"]);
    }

    public function getFulfillmentsByExerciseId($exerciseId): array
    {
        return $this->qb->table("fulfillments")->where("id_exercise", "=", $exerciseId)->get();
    }

    public function getFulfillment(mixed $fulfillmentId)
    {
        return $this->qb->table("fulfillments")->where("id_fulfillment", "=", $fulfillmentId)->get();
    }

    public function deleteFulfillment($fulfillmentId): void
    {
        $this->deleteAnswersByFulfillmentId($fulfillmentId);
        $this->qb->table("fulfillments")->where("id_fulfillment", "=", $fulfillmentId)->delete();
    }

    private function deleteAnswersByFulfillmentId($fulfillmentId): void
    {
        $this->qb->table("answers")->where("id_fulfillment", "=", $fulfillmentId)->delete();
    }

    public function updateAnswers(mixed $fulfillmentId, array $answers)
    {
        foreach ($answers as $idField => $value) {
            $this->qb->table("answers")->where("id_fulfillment", "=", $fulfillmentId)->where("id_field", "=", $idField)->update(['answer' => $value]);
        }
    }
}
