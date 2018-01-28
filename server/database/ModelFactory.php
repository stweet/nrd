<?php

namespace database {
    
    abstract 
    class ModelFactory {

        static 
        private $models = [];
        
        /**
         * Динамическая подгрузка моделй по имени класса
         */
        static 
        public function loadModel(string $name) {
            $type = \MainConfig::DB_TYPE;
            $className = "database\\models\\$type\\$name";
            return self::$models[$name] = new $className();
        }
    }
}