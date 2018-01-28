<?php

namespace views\bootstrap\base {

    use document\Template;
    
    abstract 
    class BootstrapView extends \View {

        public function __construct() {
            parent::__construct();
            
            parent::addScriptPath("/public/js/jquery-3.3.1.min.js");
            parent::addScriptPath("/public/js/bootstrap.min.js");
            
            parent::addStylePath("/public/css/bootstrap.min.css");
        }

        public function setLayout(string $layout) {
            parent::setLayout("bootstrap/layouts/{$layout}");
        }
        
        public function addWidget(string $group, array $args, string $layout) {
            parent::addWidget($group, $args, "bootstrap/widgets/{$layout}");
        }
    }
}