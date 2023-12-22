<?php

namespace App\Controllers;

use App\models\Exercise;
use Mugiwaras\Framework\Core\Renderer;

class baseController
{
    protected Exercise $model;
    protected Renderer $renderer;
    public function __construct()
    {
        $this->renderer = new Renderer(dirname(__DIR__) . '/views');
        $this->model = new Exercise();
    }
}