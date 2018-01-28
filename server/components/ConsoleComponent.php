<?php 

namespace components {
    
    use components\MainComponent;
    
    /**
     * Компонент работы с консолью
     */
    class ConsoleComponent extends MainComponent {
        
        /**
         * Регистрация комманд
         *
         * @return void
         */
        protected function registry() {
            parent::registryCli('/help', 'components\\console\\HelpController@index');
            parent::registryCli('/install', 'components\\install\\DBaseController@install');
            parent::registryCli('/uninstall', 'components\\install\\DBaseController@uninstall');
        }
    }
}