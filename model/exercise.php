<?php
class exercise
{
    function getAllExercises(){
        return DatabaseConnection::dbConnect()->query("SELECT title_exercise FROM exercises")->fetchAll();
    }
}