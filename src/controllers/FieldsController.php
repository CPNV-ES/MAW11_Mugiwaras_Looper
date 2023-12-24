<?php

namespace App\Controllers;

use App\core\Renderer;
use App\models\exerciseModel;
use App\models\fieldModel;
use Mugiwaras\Framework\Core\Controller;

class FieldsController extends controller
{
    private fieldModel $fieldModel;
    private exerciseModel $exerciseModel;

    public function __construct()
    {
        parent::__construct();
        $this->fieldModel = new fieldModel();
        $this->exerciseModel = new exerciseModel();
    }

    public function index(array $uriParams)
    {
        $exercise = $this->exerciseModel->getExerciseById($uriParams['exerciseId']);
        $fields = $this->fieldModel->getFields($exercise[0]['id_exercise']);

        $data = ["exercise" => $exercise[0], "fields" => $fields];
        $this->renderer->render("newFields", $data);
    }

    public function create(array $data): void
    {
        $label = $data['fieldLabel'] ?? '';
        $fieldKind = $data['fieldKind'] ?? '';

        $this->fieldModel->addField($label, $fieldKind, $data['exerciseId']);

        header("Location: /exercises/" . $data['exerciseId'] . "/fields");
    }

    public function delete(array $uriParams): void
    {
        $this->fieldModel->deleteField($uriParams['exerciseId'], $uriParams['fieldId']);

        header("Location: /exercises/" . $uriParams['exerciseId'] . "/fields");
    }

    public function edit(array $uriParams): void
    {
        $exercise = $this->exerciseModel->getExerciseById($uriParams['exerciseId']);
        $field = $this->fieldModel->getFieldById($uriParams['fieldId']);

        $data = ["exercise" => $exercise[0], "field" => $field[0]];
        $this->renderer->render("editField", $data);
    }

    public function update(array $data): void
    {
        $label = $data['fieldLabel'] ?? '';
        $fieldKind = $data['fieldKind'] ?? '';

        $this->fieldModel->updateField($label, $fieldKind, $data['fieldId']);

        header("Location: /exercises/" . $data['exerciseId'] . "/fields");
    }
}