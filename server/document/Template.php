<?php

namespace document {

    use document\Widgets;
    use document\Scripts;
    use document\Styles;
    
    class Template {

        static 
        public function renderLayout(string $layout, array $args): string {
            $tmpl = __ROOT__."/views/{$layout}.php";
            
            \ob_start();
            \extract($args);
            require_once $tmpl;
            return \ob_get_clean();
        }
        
        public $layout = "";
        public $title = "";

        public $widgets;
        public $scripts;
        public $styles;
        
        public function __construct() {
            $this->widgets = new Widgets();
            $this->scripts = new Scripts();
            $this->styles = new Styles();
        }

        public function render() {
            if (!$this->layout) return "Layout not found";
            
            $scripts = $this->scripts->generatePaths();
            $scripts .= $this->scripts->generateTexts();
            
            $styles = $this->styles->generatePaths();
            $styles .= $this->styles->generateTexts();
            
            return self::renderLayout($this->layout ?? "", [
                "widgets" => $this->widgets,
                "title" => $this->title,
                "scripts" => $scripts,
                "styles" => $styles
            ]);
        }
    }
}