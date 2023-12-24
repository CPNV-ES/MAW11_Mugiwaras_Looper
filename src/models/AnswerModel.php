<?php

namespace App\models;

use Mugiwaras\Framework\Core\Model;

class AnswerModel extends Model
{
    public function getAnswersFromFulfillmentId(mixed $fulfillmentId): false|array
    {
        return $this->qb->table("answers")->where("id_fulfillment", "=", $fulfillmentId)->get();
    }

    public function saveAnswers(mixed $exerciseId, array $answers)
    {
        $fulfillmentId = $this->addFulfillment($exerciseId);
        foreach ($answers as $idField => $value) {
            $this->qb->table("answers")->save(
                ["id_field" => $idField, "id_fulfillment" => $fulfillmentId, "answer" => $value]
            );
        }
        return $fulfillmentId;
    }
    public function addFulfillment($exerciseId): false|string
    {
        return $this->qb->table("fulfillments")->save(["id_exercise" => $exerciseId]);
    }
    public function getAnswers($fulfillmentId)
    {
        return $this->qb->table("answers")->where("id_fulfillment", "=", $fulfillmentId)->get();
    }

    public function getAnswersByExerciseId($exerciseId): array
    {
        return $this->qb->table("answers AS a")->join("fields AS f", "a.id_field", "f.id_field")->join(
            "fulfillments AS ful",
            "a.id_fulfillment",
            "ful.id_fulfillment"
        )->where("f.id_exercise", "=", $exerciseId)->get(["a.*, f.label AS field_label, ful.submited_at, f.id_exercise"]
        );
    }

    public function getAnswersByFieldsId(int $fieldId): array
    {
        return $this->qb->table("answers AS a")->join("fields AS f", "a.id_field", "f.id_field")->join(
            "fulfillments AS ful",
            "a.id_fulfillment",
            "ful.id_fulfillment"
        )->where("a.id_field", "=", $fieldId)->get(["a.*, f.label AS field_label, ful.submited_at, f.id_exercise"]);
    }

    public function updateAnswers(mixed $fulfillmentId, array $answers)
    {
        foreach ($answers as $idField => $value) {
            $this->qb->table("answers")->where("id_fulfillment", "=", $fulfillmentId)->where(
                "id_field",
                "=",
                $idField
            )->update(['answer' => $value]);
        }
    }
}