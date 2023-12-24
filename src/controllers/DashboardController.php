<?php
namespace App\controllers;

use Mugiwaras\Framework\Core\Controller;

class DashboardController extends controller
{
    public function index(): void
    {
        $dynamicHeader = [
            'currentPage' => 'dashboard-page'
        ];
        $this->renderer->render("dashboard", $dynamicHeader);
    }
}