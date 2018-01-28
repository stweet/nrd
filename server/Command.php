<?php

use routes\Route;
use routes\RouteError;

/**
 * Объект пытается безопасно инициализовать контроллер
 * и выполнить запрос.
 */
abstract 
class Command {
    
    static 
    public function run(Route $route) {
        list ($controller, $action) = explode("@", $route->getAction());
        
        $cls = new $controller($route);
        
        if (!method_exists($cls, $action)) {
            echo "Command: Method not found\n";
            return;
        }
        
        try {
            $args = $route->parse($_SERVER['REQUEST_URI']);
            call_user_func_array([$cls, $action], $args);
        } catch(\Exception $e) {
            echo "Command: ".$e->getMessage();
        }
    }
}