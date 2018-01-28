<?php
/**
 * 
 * Точка входа.
 */

include_once "common/constants.php";
include_once "common/functions.php";
include_once "common/handlers.php";

use routes\Route;
use routes\RouteError;
use routes\RouteCollection;

use components\TaskComponent;
use components\ConsoleComponent;

use views\ViewFactory;

/**
 * Основной класс программы
 */
class Main {
    
    static 
    private $__inst__ = null;
    
    static
    public function run(string $query = "") {
        if (self::$__inst__ instanceof self) return;
        
        self::$__inst__ = new Main();
        self::$__inst__->registry();
        self::$__inst__->execute();
    }
    
    private $collection;
    private $install;
    private $task;

    /** Инициализация системы */
    private function __construct() {
        $this->collection = new RouteCollection();
    }
    
    /** Регистрация компонентов */
    private function registry() {
        $this->install = new ConsoleComponent($this->collection);
        $this->task = new TaskComponent($this->collection);
    }
    
    /** Выполнение программы */
    private function execute() {
        $uri = "/".trim($_SERVER['REQUEST_URI'], "/");
        $method = trim($_SERVER['REQUEST_METHOD']);

        // По запросу и его типу определяем контроллер
        $route = $this->collection->getRoute($uri, $method);
        
        // Пытаемся выполнить
        if ($route) return Command::run($route);
        else ViewFactory::load("ErrorView")->render();
    }
}