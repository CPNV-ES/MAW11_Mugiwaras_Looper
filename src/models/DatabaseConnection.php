<?php

namespace App\models;

use PDO;

class DatabaseConnection
{
    public static function dbConnect(): PDO
    {
        return new PDO(getenv('PDO_DSN', true), getenv('PDO_USERNAME', true), getenv('PDO_PASSWORD', true));
    }
}