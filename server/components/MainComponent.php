<?php

namespace components {

    use routes\Route;
    use routes\RouteCollection;

    /**
     * Базовый компонент
     */
    abstract 
    class MainComponent {
        
        protected $collection;

        public function __construct(RouteCollection $collection) {
            $this->collection = $collection;
            $this->registry();
        }

        /** Заставляем наследников реализовать данный метод */
        abstract
        protected function registry();

        /** Для комворта добавил пару методов регистрации маршрутов */

        /** Регистрирует POST запросы */
        protected function registryPost(string $action, string $controller) {
            $route = new Route($action, $controller, Route::POST);
            $this->collection->addRoute($route);
        }
        
        /** Регистрирует GET запросы */
        protected function registryGet(string $action, string $controller) {
            $route = new Route($action, $controller, Route::GET);
            $this->collection->addRoute($route);
        }

        /** Хак для работы с консолью */
        protected function registryCli(string $action, string $controller) {
            $route = new Route($action, $controller, Route::CLI);
            $this->collection->addRoute($route);
        }
    }
}