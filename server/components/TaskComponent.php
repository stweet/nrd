<?php 

namespace components {
    
    use components\MainComponent;

    /**
     * Компонет работы с задачами
     */
    class TaskComponent extends MainComponent {

        /**
         * Метод запаковывает в JSON объект команду и данные обработки запроса.
         *
         * По хорошему данные методы лучше выносить в общие возможности системы 
         * а не держать на уровне компонента
         * 
         * @param string $command 
         * @param array $args
         * @return string
         */
        static 
        public function packCommand(string $command, array $args): string {
            return \json_encode(["cmd" => $command, "args" => $args]);
        }

        /**
         * Для комфорта вынес отправку ошибок в клиенту в отдельный метод
         *
         * @param string $message Сообщение пользователю.
         * @return void
         */
        static 
        public function packSysemError(string $message) {
            return self::packCommand("system.error", [
                "message" => $message,
                "type" => "danger"
            ]);
        }
        
        /**
         * Регистрация комманд
         *
         * @return void
         */
        protected function registry() {
            parent::registryGet('/', 'components\\task\\ItemsController@index');
            parent::registryPost('/tasks', 'components\\task\\ItemsController@items');
            
            parent::registryPost('/task-create', 'components\\task\\ItemController@create');
            parent::registryPost('/task-update', 'components\\task\\ItemController@update');
            parent::registryPost('/task-change', 'components\\task\\ItemController@change');
            parent::registryPost('/task-remove', 'components\\task\\ItemController@remove');
        }
    }
}