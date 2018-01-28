<?php

namespace routes {
    
    class Route {
        
        const DELETE = "DELETE";
        const UPDATE = "UPDATE";
        const POST = "POST";
        const GET = "GET";
        const PUT = "PUT";
        const CLI = "CLI";
        
        private $reserv = [
            "id" => "[0-9]+",
            "string" => "[a-zA-Z0-9_-]+"
        ];
        
        private $method = "GET";
        private $regexp = "";
        private $action = "";
        private $rule = "";
        
        public function __construct(string $rule, string $action, string $method) {
            $this->setAction($action);
            $this->setMethod($method);
            $this->setRule($rule);
        }
        
        public function getAction(): string {
            return $this->action;
        }
        
        public function setAction(string $action) {
            $this->action = $action;
        }
        
        public function getMethod(): string {
            return $this->method;
        }
        
        public function setMethod(string $method) {
            $this->method = $method;
        }
        
        public function getRule(): string {
            return $this->rule;
        }
        
        public function setRule(string $rule) {
            $this->rule = "/".trim($rule, "/");
            $this->update();
        }
        
        public function where(string $name, string $regular) {
            $this->reserv[$name] = $regular;
            $this->update();
        }
        
        public function parse(string $url, array $matches = []) {
            if (empty($this->rule) || $this->rule == "/") {
                return [];
            }
            
            preg_match($this->regexp, $url, $matches);
            array_shift($matches);
            return $matches;
        }
        
        public function test(string $url, string $method) {
            return preg_match($this->regexp, $url) && 
                $this->method == $method;
        }
        
        private function update() {

            if (strlen($this->rule) <= 1) {
                $this->regexp = "#^/$#";
                return ;
            }
            
            $sections = [];
            foreach (explode("/", $this->rule) as $section) {
                if (empty($section)) continue;
                
                $matches = [];
                preg_match("#^{(\w+)}$#", $section, $matches);
                
                if (count($matches) >= 2) {
                    $name = (string) $matches[1];
                    $regx = $this->regexp($name);
                    $sections[] = "({$regx})";
                } else {
                    $sections[] = $section;
                }
            }
            
            $regexp = "/".join("/", $sections);
            $this->regexp = "#^{$regexp}$#";
        }
        
        private function regexp(string $name) {
            if (isset($this->reserv[$name]))
                return $this->reserv[$name];
            return $this->reserv["string"];
        }
    }
}