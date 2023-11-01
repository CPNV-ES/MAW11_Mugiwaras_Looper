<?php

namespace App\controllers;

use App\core\Renderer;


class HomeController {
    public function index(): void
    {
        $dynamicHeader = [
            'currentPage' => 'dashboard-page'
        ];
        Renderer::render("dashboard", $dynamicHeader);
    }
}