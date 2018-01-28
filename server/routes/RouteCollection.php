<?php

namespace routes {
    
    use routes\Route;
    
    class RouteCollection {
        
        private $collection = [];
        
        public function addRoute(Route $route) {
            $method = $route->getMethod();
            
            if (empty($this->collection[$method])) {
                $this->collection[$method] = [];
            }

            $this->collection[$method][] = $route;
        }
        
        public function getRoute(string $url, string $method = "GET")  {
            if (empty($this->collection[$method])) return null;

            foreach($this->collection[$method] as $route) {
                if ($route->test($url, $method)) {
                    return $route;
                }
            }
            
            return null;
        }
    }
}