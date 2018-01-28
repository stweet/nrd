<?php 

namespace components\install {

    use database\ModelFactory;
    
    /**
     * Контроллер установки и/или удаления базы данных
     */
    class DBaseController {

        public function install() {
            ModelFactory::load("base\\Install")->apply();
        }

        public function uninstall() {
            ModelFactory::load("base\\Uninstall")->apply();
        }
    }
}