<?php

namespace App\Model;

use PDO;
use PDOException;


class DatabaseConnection {
    private $pdo;


    /**
     * @throws \Exception
     */
    public function __construct() {


        $dsn = getenv('PDO_DSN',true);
        $username = getenv('PDO_USERNAME', true);
        $password = getenv('PDO_PASSWORD', true);

        if (!$dsn || !$username || !$password) {

            throw new \Exception("Database configuration is missing.");
        }

        try {
            $this->pdo = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            throw new \Exception("Database connection error: " . $e->getMessage());
        }
    }

    public function dbConnect(): PDO {
        return $this->pdo;
    }
}