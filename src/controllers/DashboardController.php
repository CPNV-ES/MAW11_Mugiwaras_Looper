<?php

namespace App\controllers;

class DashboardController extends baseController
{
    public function index(): void
    {
        $dynamicHeader = [
            'currentPage' => 'dashboard-page'
        ];
        $this->renderer->render("dashboard", $dynamicHeader);
    }
}