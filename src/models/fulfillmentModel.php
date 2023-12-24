<?php

namespace App\models;

use Mugiwaras\Framework\Core\Model;

class fulfillmentModel extends Model
{
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
}