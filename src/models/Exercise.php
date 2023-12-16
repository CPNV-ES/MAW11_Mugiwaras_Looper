<?php

namespace App\models;

use App\models\DatabaseConnection;
use PDO;

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
    public function getExerciseById($exerciseId): array
    {
        return $this->db->query("SELECT * from exercises WHERE id_exercise = $exerciseId")->fetchAll();
    }

    public function getAllExercisesAnswering(): array|false
    {
        // Get the exercises from the database (titles and ids)
        return $this->db->query(
            "SELECT id_exercise, title_exercise FROM exercises WHERE status = 'Answering'"
        )->fetchAll();
    }

    public function getAllExercises(): array|false
    {
        // Get the exercises from the database (titles and ids)
        return $this->db->query(
            "SELECT id_exercise, title_exercise, status FROM exercises WHERE status IN ('Building', 'Answering', 'Closed')"
        )->fetchAll();
    }

    public function getAnswersFromFulfillmentId(mixed $fulfillmentId): false|array
    {
        return $this->db->query("SELECT * from answers WHERE id_fulfillment = $fulfillmentId")->fetchAll();
    }

    public function addExercise(string $title): ?int
    {
        // Add the exercise to the database
        $statement = $this->db->prepare("INSERT INTO exercises (title_exercise, status) VALUES (:title, 'Building')");

        if ($statement->execute(['title' => $title])) {
            return (int)$this->db->lastInsertId();
        }

        return null;
    }

    public function addFulfillment($exerciseId): false|string
    {
        $statement = $this->db->prepare("INSERT INTO fulfillments (id_exercise) VALUES (:exerciseId)");
        $statement->execute(['exerciseId' => $exerciseId]);
        return $this->db->lastInsertId();
    }

    public function getFieldById($fieldId)
    {
        return $this->db->query("SELECT * from fields WHERE id_field = $fieldId")->fetchAll();
    }

    public function deleteField($exerciseId, $fieldId)
    {
        $statement = $this->db->prepare("DELETE FROM fields WHERE id_field = :fieldId");
        $statement->execute(['fieldId' => $fieldId]);
    }

    public function addField($label, $fieldKind, $exercise)
    {
        $statement = $this->db->prepare(
            "INSERT INTO fields (label, value_kind, id_exercise) VALUES (:label, :fieldKind, :exercise)"
        );
        $statement->execute(['label' => $label, 'fieldKind' => $fieldKind, 'exercise' => $exercise]);
    }

    public function updateField($label, $fieldKind, $fieldId): void
    {
        $statement = $this->db->prepare(
            "UPDATE fields SET label = :label, value_kind = :fieldKind WHERE id_field = :fieldId"
        );
        $statement->execute(['label' => $label, 'fieldKind' => $fieldKind, 'fieldId' => $fieldId]);
    }

    public function getFields($exerciseId): false|array
    {
        $statement = $this->db->prepare("SELECT id_field, label, value_kind FROM fields WHERE id_exercise = :exerciseId");
        $statement->execute(['exerciseId' => $exerciseId]);
        return $statement->fetchAll();
    }

    public function deleteExercise($exerciseId): void
    {
        $statement = $this->db->prepare("DELETE FROM exercises WHERE id_exercise = :exerciseId");
        $statement->execute(['exerciseId' => $exerciseId]);
    }

    public function getCategorizedExercises(): array
    {
        $allExercises = $this->getAllExercises();

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

    public function updateExerciseStatus($exerciseId, $newStatus): void
    {
        $statement = $this->db->prepare("UPDATE exercises SET status = :newStatus WHERE id_exercise = :exerciseId");
        $statement->execute(['newStatus' => $newStatus, 'exerciseId' => $exerciseId]);
    }

    public function saveAnswers(mixed $exerciseId, array $answers)
    {
        $fulfillmentId = $this->addFulfillment($exerciseId);
        $statement = $this->db->prepare(
            "INSERT INTO answers (id_field, id_fulfillment, answer) VALUES (:idField, :idFulfillment, :answer)"
        );
        foreach ($answers as $idField => $value) {
            $statement->execute(['idField' => $idField, 'idFulfillment' => $fulfillmentId, 'answer' => $value]);
        }
        return $fulfillmentId;
    }
    public function getExercise($exerciseId): array
    {
        $statement = $this->db->prepare("SELECT * FROM exercises WHERE id_exercise = :exerciseId");
        $statement->execute(['exerciseId' => $exerciseId]);
        return $statement->fetchAll();
    }

    public function getAnswers($fulfillmentId)
    {
        $statement = $this->db->prepare("SELECT * FROM answers WHERE id_fulfillment = :fulfillmentId");
        $statement->execute(['fulfillmentId' => $fulfillmentId]);
        return $statement->fetchAll();
    }

    public function getAnswersByExerciseId($exerciseId): array
    {
        // Using a JOIN query for better performance and readability
        $statement = $this->db->prepare("
        SELECT a.*, f.label AS field_label, ful.submited_at, f.id_exercise
        FROM answers AS a
        JOIN fields AS f ON a.id_field = f.id_field
        JOIN fulfillments AS ful ON a.id_fulfillment = ful.id_fulfillment
        WHERE f.id_exercise = :exerciseId;
    ");

        // Binding the parameter
        $statement->bindParam(':exerciseId', $exerciseId, PDO::PARAM_INT);

        // Executing the query
        $statement->execute();

        // Fetching all results
        return $statement->fetchAll();
    }

    public function getAnswersByFieldsId(int $fieldId): array
    {
        $statement = $this->db->prepare("
        SELECT a.*, f.label AS field_label, ful.submited_at, f.id_exercise
        FROM answers AS a
        JOIN fields AS f ON a.id_field = f.id_field
        JOIN fulfillments AS ful ON a.id_fulfillment = ful.id_fulfillment
        WHERE a.id_field = :fieldId;
        ");

        $statement->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll();

    }

    public function getFulfillmentsByExerciseId($exerciseId): array
    {
        $statement = $this->db->prepare("SELECT * FROM fulfillments WHERE id_exercise = :exerciseId");
        $statement->execute(['exerciseId' => $exerciseId]);
        return $statement->fetchAll();
    }

    public function getFulfillment(mixed $fulfillmentId)
    {
        $statement = $this->db->prepare("SELECT * FROM fulfillments WHERE id_fulfillment = :fulfillmentId");
        $statement->execute(['fulfillmentId' => $fulfillmentId]);
        return $statement->fetchAll();
    }

    public function deleteFulfillment($fulfillmentId): void
    {
        $this->deleteAnswersByFulfillmentId($fulfillmentId);
        $statement = $this->db->prepare("DELETE FROM fulfillments WHERE id_fulfillment = :fulfillmentId");
        $statement->execute(['fulfillmentId' => $fulfillmentId]);
    }

    private function deleteAnswersByFulfillmentId($fulfillmentId): void
    {
        $statement = $this->db->prepare("DELETE FROM answers WHERE id_fulfillment = :fulfillmentId");
        $statement->execute(['fulfillmentId' => $fulfillmentId]);
    }


    public function updateAnswers(mixed $fulfillmentId, array $answers)
    {
        $statement = $this->db->prepare(
            "UPDATE answers SET answer = :answer WHERE id_fulfillment = :fulfillmentId AND id_field = :idField"
        );
        foreach ($answers as $idField => $value) {
            $statement->execute(['answer' => $value, 'fulfillmentId' => $fulfillmentId, 'idField' => $idField]);
        }
    }
}