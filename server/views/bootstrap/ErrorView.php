<?php

namespace views\bootstrap {
    
    use views\bootstrap\base\BootstrapView;

    class ErrorView extends BootstrapView {
        
        public function __construct(){
            parent::__construct();
            
            parent::setTitle("404 Error");
            parent::setLayout("404");
        }
    }
}