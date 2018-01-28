<?php

namespace database\models\pdo\drivers {

    use database\models\pdo\drivers\PDOConfig;
    
    /**
     * Драйвер работы с MYSQL
     */
    abstract 
    class PDODriver {

        static 
        private $__inst__;

        static
        public function connect() {
            
            if (self::$__inst__ == null) {
                self::$__inst__ = self::inst();
            }

            return self::$__inst__;
        }

        static 
        private function inst(): \PDO {
            return new \PDO(self::getDsn(), PDOConfig::DB_USER, PDOConfig::DB_PASS);
        }

        static 
        private function getDsn(): string {
            $dsn  = PDOConfig::DB_TYPE;
            $dsn .= ":dbname=";
            $dsn .= PDOConfig::DB_NAME;
            $dsn .= ";host=";
            $dsn .= PDOConfig::DB_HOST;
            // $dsn .= ";charset=utf-8";
            return $dsn;
        }
    }
}