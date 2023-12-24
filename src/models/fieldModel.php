<?php

namespace App\models;

use Mugiwaras\Framework\Core\Model;

class fieldModel extends Model
{
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
        return $this->qb->table("fields")->save(
            ["label" => $label, "value_kind" => $fieldKind, "id_exercise" => $exercise]
        );
    }

    public function updateField($label, $fieldKind, $fieldId): void
    {
        $this->qb->table("fields")->where("id_field", "=", $fieldId)->update(
            ["label" => $label, "value_kind" => $fieldKind]
        );
    }

    public function getFields($exerciseId): false|array
    {
        return $this->qb->table("fields")->where("id_exercise", "=", $exerciseId)->get(
            ["id_field", "label", "value_kind"]
        );
    }
}