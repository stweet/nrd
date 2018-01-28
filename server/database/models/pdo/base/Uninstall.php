<?php

namespace database\models\pdo\base {
    
    use database\models\pdo\base\Model;

    class Uninstall extends Model {

        public function apply() {
            $this->query("drop table if exists tasks;");
        }

        protected function query(string $request) {
            
            if ($result = parent::query($request)) {
                \__pre("COMPLETE REQUEST $request");
            } else {
                \__pre("ERROR REQUEST $request");
            }
        }
    }
}