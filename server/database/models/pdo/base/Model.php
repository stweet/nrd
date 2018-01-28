<?php

namespace database\models\pdo\base {
    
    use database\models\pdo\drivers\PDODriver;
    
    abstract 
    class Model {

        protected function execute(string $request, array $args = []) {
            $statement = PDODriver::connect()->prepare($request);
            $statement->execute($args);
            return $statement;
        }

        protected function lastInsertId() {
            return PDODriver::connect()->lastInsertId();
        }
    }
}