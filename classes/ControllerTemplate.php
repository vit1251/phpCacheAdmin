<?php

class Controller_Template extends Controller {

    /**
     * @var View
     */
    protected $template;

    /**
     * Подготавливает шаблон
     *
     * @return void
     */
    public function before() {
        $this->template = new View('template');
    }

    /**
     * Заканчивает обработку
     *
     * @return void
     */
    public function after() {
        Request::instance()->response = $this->template;
    }

}
