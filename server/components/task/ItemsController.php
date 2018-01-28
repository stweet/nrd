<?php 

namespace components\task {

    use views\ViewFactory;
    use database\ModelFactory;
    use components\TaskComponent;
    
    /**
     * Контроллер вывода списка задач
     * ВАЖНО! Данный контроллер доверяет клиентской части.
     */
    class ItemsController {

        /** Вывод шаблона раздела */
        public function index() {
            ViewFactory::load("TasksView")->render();
        }

        /** Выборка задач из базы данных */
        public function items() {
            
            // Думал фильтр по задачам реализовать,
            // но тут попахивает полноценной ОРМ.
            $state = \Input::post("state", "0");

            // Остановился на рамках тз.
            $where = ["*" => "", "0" => " where state=false", "1" => " where state=true"];
            $items = ModelFactory::loadModel("TasksModel")->findAll($where[$state]);
            echo TaskComponent::packCommand("tasks.items", $items);
        }
    }
}