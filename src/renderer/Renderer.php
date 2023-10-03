<?php

namespace App\Renderer;

class Renderer {
    private $viewPath;
    private $layout = 'layout';  // default layout file

    public function __construct($viewPath) {
        $this->viewPath = $viewPath;
    }

    public function render($view, $data = []) {
        $content = $this->getViewContent($view, $data);
        return $this->getViewContent($this->layout, ['content' => $content]);
    }

    private function getViewContent($view, $data = []) {
        extract($data);
        ob_start();
        include $this->viewPath . '/' . $view . '.php';
        return ob_get_clean();
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }
}
