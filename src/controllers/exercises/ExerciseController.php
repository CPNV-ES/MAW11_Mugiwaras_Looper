<?php

namespace App\controllers\exercises;

use App\Model\DatabaseConnection;
use App\Model\Exercise;

class ExerciseController {
    private $exerciseModel;

    public function __construct() {
        $dbConnection = (new DatabaseConnection())->dbConnect();
        $this->exerciseModel = new Exercise($dbConnection);
    }

    public function getExercisesForView() {
        return $this->exerciseModel->getAllTitles();
    }
}
