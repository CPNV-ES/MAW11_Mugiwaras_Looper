<?php

namespace App\Model;

use App\Model\DatabaseConnection;

class Exercise
{
    function getAllExercises()
    {
        // Get the exercises from the database (titles and ids)
        return DatabaseConnection::dbConnect()->query("SELECT id_exercise, title_exercise FROM exercises")->fetchAll();
    }

}