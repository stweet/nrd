<?php


namespace routes {

    use routes\Route;
    
    class RouteError extends Route {
        
        public function __construct(string $method) {
            parent::__construct("/", "components\\ErrorComponent@index", $method);
        }
    }
}