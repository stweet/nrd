<?php

namespace views\bootstrap\base {
    
    use views\bootstrap\base\BootstrapView;

    class TemplateView extends BootstrapView {
        
        public function __construct() {
            parent::__construct();

            parent::addScriptPath("/public/js/common/service.js");
            parent::addScriptPath("/public/js/common/application.js");
            
            parent::addStylePath("/public/css/template.css");
        }
    }
}