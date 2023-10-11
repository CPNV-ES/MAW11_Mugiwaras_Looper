<?php

namespace App\Model;

use App\Model\DatabaseConnection;

class Exercise
{
    function getAllExercises()
    function getAllExercises(): array|false
    {
        // Get the exercises from the database (titles and ids)
        return DatabaseConnection::dbConnect()->query("SELECT id_exercise, title_exercise FROM exercises")->fetchAll();
    }

}