<?php

namespace App\core;

class Renderer {
    private $viewPath;
    private $layout = 'layout';  // default layout file

    // Construct the final view
    public function __construct($viewPath) {
        $this->viewPath = $viewPath;
    }

    // Render the view with the view and the layout
    public function render($view, $data = []) {
        $content = $this->getViewContent($view, $data);
        return $this->getViewContent($this->layout, ['content' => $content]);
    }

    // Get the view to inject into the layout
    private function getViewContent($view, $data = []) {
        extract($data);
        ob_start();
        include $this->viewPath . '/' . $view . '.php';
        return ob_get_clean();
    }
}
