<?php

require_once('./databaseConnection.php');

function getAllExercises(){
    return dbConnect()->query("SELECT title_exercise FROM exercises");

}
