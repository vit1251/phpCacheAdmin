<?php

class Controller_Settings extends Controller_Template {

    public function index() {
        $configuration = Session::instance()->configuration;

        /* Сохраняем параметры подключения */
        if ( $_POST ) {
            $configuration = array(
                'server_id' => $_POST['server_id'],
            );

            Session::instance()->configuration = $configuration;
        }

        $this->template->content = new View('settings');
        $this->template->content->items = Config::get('memcache');
        $this->template->content->server_id = $configuration['server_id'];
    }

}
