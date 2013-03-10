<?php

class Request {

    /**
     * Controller to be executed
     * @var string
     */
    public $controller = 'welcome';

    /**
     * Action to be executed in the controller
     *
     * @var string
     */
    public $action = 'index';

    /**
     * Конструктор
     *
     * @params string $uri
     * @return void
     */
    public function __construct() {
        $this->controller = array_key_exists('controller', $_REQUEST) ? $_REQUEST['controller'] : 'welcome';
        $this->action = array_key_exists('action', $_REQUEST) ? $_REQUEST['action'] : 'index';

    }
   

}
