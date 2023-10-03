<?php

namespace App\Model;

use App\Model\DatabaseConnection;

class Exercise {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllTitles(){
        return $this->db->query("SELECT title_exercise FROM exercises")->fetchAll();
    }
}