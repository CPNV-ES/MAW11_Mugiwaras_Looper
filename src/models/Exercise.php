<?php

namespace App\models;

use App\models\DatabaseConnection;

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
    function addExercise(string $title): ?int
    {
        // Add the exercise to the database
        $statement = $this->db->prepare("INSERT INTO exercises (title_exercise) VALUES (:title)");

        if ($statement->execute(['title' => $title])) {
            return (int) $this->db->lastInsertId();  // Return the last inserted ID
        }

        return null;  // Return null if the insertion failed
    }

}