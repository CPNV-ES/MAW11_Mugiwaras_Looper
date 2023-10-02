<?php

namespace model;

class exercise
{
    function getAllExercises()
    {
        require_once("./model/DatabaseConnection.php");
        return DatabaseConnection::dbConnect()->query("SELECT title_exercise FROM exercises")->fetchAll();
    }
}