<?php

namespace App\Model;

use App\Model\DatabaseConnection;

class Exercise
{
    function getAllExercisesTitle()
    {
        return DatabaseConnection::dbConnect()->query("SELECT title_exercise FROM exercises")->fetchAll();
    }
}