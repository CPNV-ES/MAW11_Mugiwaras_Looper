<?php

namespace App\core;

class Renderer {
    public static function render($viewPath, $data = []): void
    {
        // Extract data so it's available as variables in the view
        extract($data);

        // Start output buffering
        ob_start();

        // Include the view
        require APP_ROOT . '/src/views/' . $viewPath . '.php';

        // Store the content of the view in a variable
        $content = ob_get_clean();

        // Include the layout and output everything
        require APP_ROOT . '/src/views/layout.php';
    }
}