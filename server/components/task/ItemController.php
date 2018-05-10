<?php 

namespace components\task {

    use database\ModelFactory;
    use components\TaskComponent;

    /**
     * Контроллер управления задачами
     * ВАЖНО! Данный контроллер доверяет клиентской части.
     */
    class ItemController {

        /** Добавление новой задачи */
        public function create() {
            $title = \Input::post("title");
            $context = \Input::post("context");
            
            $item = ModelFactory::loadModel("TaskModel")->create($title, $context);
            if ($item) echo TaskComponent::packCommand("task.create", $item);
            else echo TaskComponent::packSysemError("Invalide data!");
        }
        
        /** Обновление задачи */
        public function update() {
            $id = \Input::post("id", 0);
            $title = \Input::post("title");
            $context = \Input::post("context");

            $item = ModelFactory::loadModel("TaskModel")->updateById($id, $title, $context);
            if ($item) echo TaskComponent::packCommand("task.update", $item);
            else echo TaskComponent::packSysemError("Item not found!");
        }
        
        /** Изменение состаяния задачи */
        public function change() {
            $id = \Input::post("id", 0);
            $state = \Input::post("state", "0");

            $item = ModelFactory::loadModel("TaskModel")->changeById($id, $state);
            if ($item) echo TaskComponent::packCommand("task.change", $item);
            else echo TaskComponent::packSysemError("Item not found!");
        }

        /** Удаление задачи */
        public function remove() {
            $id = \Input::post("id", 0);

            $item = ModelFactory::loadModel("TaskModel")->removeById($id);
            if ($item) echo TaskComponent::packCommand("task.remove", $item);
            else echo TaskComponent::packSysemError("Item not found!");
        }
    }
}
