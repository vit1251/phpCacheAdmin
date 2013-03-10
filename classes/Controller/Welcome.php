<?php

class Controller_Welcome extends Controller {

    /**
     * Стандартный вход в систему
     *
     * @return void
     */
    public function index() {
        
        $template = new View('template');
        $template->content = new View('welcome');

        $response = new Response($template);
        return $response;
    }
}
