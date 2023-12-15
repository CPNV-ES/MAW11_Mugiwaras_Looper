<?php

namespace App\Controllers;

use App\models\Exercise;

class baseController
{
    protected Exercise $model;

    public function __construct()
    {
        $this->model = new Exercise();
    }
}