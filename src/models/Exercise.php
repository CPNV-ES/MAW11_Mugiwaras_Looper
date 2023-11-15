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

    public function getLastInsertedExercise(): array
    {
        return $this->db->query("SELECT * from exercises order by id_exercise desc limit 1")->fetchAll();
    }

    public function getAllExercises(): array
    {
        // Get the exercises from the database (titles and ids)
        return $this->db->query("SELECT id_exercise, title_exercise FROM exercises WHERE status = 'Answering'")->fetchAll();
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
    public function addField($label, $fieldKind, $exercise)
    {
        $statement = $this->db->prepare("INSERT INTO fields (label, value_kind, id_exercise) VALUES (:label, :fieldKind, :exercise)");
        $statement->execute(['label'=> $label, 'fieldKind'=>$fieldKind, 'exercise'=> $exercise]);
    }
    public function getFields($exerciseId){
        return $this->db->query("SELECT id_field, label, value_kind from fields WHERE id_exercise = $exerciseId")->fetchAll();
    }
}