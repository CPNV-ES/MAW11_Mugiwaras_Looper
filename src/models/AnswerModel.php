<?php

namespace App\models;

use Mugiwaras\Framework\Core\Model;
use App\models\fulfillmentModel;

class AnswerModel extends Model
{
    private $fulfillmentModel;

    public function __construct()
    {
        parent::__construct();
        $this->fulfillmentModel = new fulfillmentModel();
    }

    public function getAnswersFromFulfillmentId(mixed $fulfillmentId): bool|array
    {
        return $this->qb->table("answers")->where("id_fulfillment", "=", $fulfillmentId)->get();
    }

    public function saveAnswers(mixed $exerciseId, array $answers): bool|string
    {
        $fulfillmentId = $this->fulfillmentModel->addFulfillment($exerciseId);
        foreach ($answers as $idField => $value) {
            $this->qb->table("answers")->save(
                ["id_field" => $idField, "id_fulfillment" => $fulfillmentId, "answer" => $value]
            );
        }
        return $fulfillmentId;
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