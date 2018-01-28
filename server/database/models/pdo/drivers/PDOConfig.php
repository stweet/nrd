<?php

namespace database\models\pdo\drivers {
    
    /**
     * Конфигурация соединения.
     */
    class PDOConfig {
        
        const DB_TYPE = "mysql";

        const DB_NAME = "tzphp";
        
        const DB_HOST = "localhost";
        
        const DB_USER = "root";
        
        const DB_PASS = "root";
    }
}