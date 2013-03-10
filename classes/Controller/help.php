<?php

class Controller_Help extends Controller_Template {

    /**
     * Выводит справку по работе с сервером
     *
     * @return void
     */
    public function index() {
        $this->template->content = new View('help');
    }

}
