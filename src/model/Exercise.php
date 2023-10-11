<?php

namespace App\Model;

use App\Model\DatabaseConnection;

class Exercise
{
    private $db;

    // DbConnect in the constructor will execute the connection once for every method in this class
    function __construct()
    {
        $this->db = DatabaseConnection::dbConnect();
    }
    function getAllExercises(): array|false
    {
        // Get the exercises from the database (titles and ids)
        return $this->db->query("SELECT id_exercise, title_exercise FROM exercises")->fetchAll();
    }

}