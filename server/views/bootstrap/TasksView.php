<?php

namespace views\bootstrap {
    
    use views\bootstrap\base\TemplateView;

    class TasksView extends TemplateView {
        
        public function __construct() {
            parent::__construct();
            
            parent::addScriptPath("/public/js/tasks/items.js");
            parent::setLayout("tasks");
        }
    }
}