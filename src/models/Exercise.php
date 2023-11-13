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

    public function getAllExercisesAnswering(): array|false
    {
        // Get the exercises from the database (titles and ids)
        return $this->db->query("SELECT id_exercise, title_exercise FROM exercises WHERE status = 'Answering'")->fetchAll();
    }
    public function getAllExercises(): array|false
    {
        // Get the exercises from the database (titles and ids)
        return $this->db->query("SELECT id_exercise, title_exercise, status FROM exercises WHERE status IN ('Building', 'Answering', 'Closed')")->fetchAll();
    }


    public function addExercise(string $title): ?int
    {
        // Add the exercise to the database
        $statement = $this->db->prepare("INSERT INTO exercises (title_exercise, status) VALUES (:title, 'Building')");

        if ($statement->execute(['title' => $title])) {
            return (int) $this->db->lastInsertId();  // Return the last inserted ID
        }

        return null;  // Return null if the insertion failed
    }
    public function getCategorizedExercises(): array {
        // Fetch all exercises
        $allExercises = $this->getAllExercises();

        // Initialize arrays for each status category
        $categorizedExercises = [
            'Building' => [],
            'Answering' => [],
            'Closed' => []
        ];

        // Categorize exercises based on their status
        foreach ($allExercises as $exercise) {
            $categorizedExercises[$exercise['status']][] = $exercise;
        }
        return $categorizedExercises;
    }



}