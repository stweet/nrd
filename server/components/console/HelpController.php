<?php 

namespace components\console {
    
    /**
     * Консольный хелпер
     */
    class HelpController {

        public function index() {
            $this->print("Тестовое задание на должность 'PHP программист' в компанию 'НРД'");
            
            $this->print("Консольные команды:");
            $this->print("php index.php help                - Вывод справки");
            $this->print("php index.php install             - Установка базы данных проекта");
            $this->print("./install.sh                      - Установка базы данных проекта(bash)");
            $this->print("php index.php uninstall           - Удаление базы данных проекта");
            $this->print("./uninstall.sh                    - Удаление базы данных проекта(bash)");
            $this->print("php -S localhost:8000 index.php   - Запуск проекта");
            $this->print("./server.sh                       - Запуск проекта(bash)");
        }

        private function print(string $message) {
            echo "$message\n";
        }
    }
}