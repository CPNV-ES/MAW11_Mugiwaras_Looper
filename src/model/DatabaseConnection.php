<?php

namespace App\Model;

use PDO;

class DatabaseConnection
{
    public static function dbConnect(){
        return new PDO(getenv('PDO_DSN', true), getenv('PDO_USERNAME', true), getenv('PDO_PASSWORD', true));

    }
}