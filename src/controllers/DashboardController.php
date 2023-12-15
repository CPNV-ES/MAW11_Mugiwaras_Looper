<?php

namespace App\controllers;

use App\core\Renderer;


class DashboardController
{
    public function index(): void
    {
        $dynamicHeader = [
            'currentPage' => 'dashboard-page'
        ];
        Renderer::render("dashboard", $dynamicHeader);
    }
}