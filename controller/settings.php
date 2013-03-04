<?php

class Controller_Settings extends Controller_Template {

    /**
     */
    public function index() {

        //var_dump($_SESSION);
        //var_dump($_POST);

        /* Сохраняем параметры подключения */
        if ( array_key_exists('data', $_POST) ) {
            $_SESSION['host'] = $_POST['data']['host'];
            $_SESSION['port'] = $_POST['data']['port'];
            $_SESSION['timeout'] = $_POST['data']['timeout'];
        }

        $this->template->content = new View('settings');

        $this->template->content->inputHost = array_key_exists('host', $_SESSION) ? $_SESSION['host'] : '127.0.0.1';
        $this->template->content->inputPort = array_key_exists('port', $_SESSION) ? $_SESSION['port'] : '11211';
        $this->template->content->inputTimeout = array_key_exists('timeout', $_SESSION) ? $_SESSION['timeout'] : 5;
    }

}
