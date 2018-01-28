<?php

namespace views {
    
    abstract 
    class ViewFactory {

        static 
        private $views = [];

        static 
        public function load(string $name) {

            $theme = \MainConfig::UITHEME;
            $className = "views\\$theme\\$name";
            return self::$views[$name] = new $className();
        }
    }
}