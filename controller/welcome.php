<?php

class Controller_Welcome extends Controller {

    /**
     * Стандартный вход в систему
     *
     * @return void
     */
    public function index() {
        $configuration = Session::instance()->configuration;
        if ( empty($configuration) ) {
            // Редирект на контроллер с конфигурацией ...
        }

        // Иначе выводим какой-нить CHANGE LOG
        $template = new View('template');
        $template->content = new View('welcome');
        
        echo $template;
    }
}
