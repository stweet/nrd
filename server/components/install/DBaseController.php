<?php 

namespace components\install {

    use database\ModelFactory;
    
    /**
     * Контроллер установки и/или удаления базы данных
     */
    class DBaseController {

        public function install() {
            ModelFactory::loadModel("base\\Install")->apply();
        }

        public function uninstall() {
            ModelFactory::loadModel("base\\Uninstall")->apply();
        }
    }
}