<?php

namespace App\Controllers;

use App\core\Renderer;

class FieldsController extends baseController
{
    public function index(array $uriParams)
    {
        $exercise = $this->model->getExerciseById($uriParams['exerciseId']);
        $fields = $this->model->getFields($exercise[0]['id_exercise']);

        $data = ["exercise" => $exercise[0], "fields" => $fields];
        $this->renderer->render("newFields", $data);
    }

    public function create(array $data): void
    {
        $label = $data['fieldLabel'] ?? '';
        $fieldKind = $data['fieldKind'] ?? '';

        $this->model->addField($label, $fieldKind, $data['exerciseId']);

        header("Location: /exercises/" . $data['exerciseId'] . "/fields");
    }
    public function delete(array $uriParams): void
    {
        $this->model->deleteField($uriParams['exerciseId'], $uriParams['fieldId']);

        header("Location: /exercises/" . $uriParams['exerciseId'] . "/fields");
    }
    public function edit(array $uriParams): void
    {
        $exercise = $this->model->getExerciseById($uriParams['exerciseId']);
        $field = $this->model->getFieldById($uriParams['fieldId']);

        $data = ["exercise" => $exercise[0], "field" => $field[0]];
        $this->renderer->render("editField", $data);
    }
    public function update(array $data): void
    {
        $label = $data['fieldLabel'] ?? '';
        $fieldKind = $data['fieldKind'] ?? '';

        $this->model->updateField($label, $fieldKind, $data['fieldId']);

        header("Location: /exercises/" . $data['exerciseId'] . "/fields");
    }
}