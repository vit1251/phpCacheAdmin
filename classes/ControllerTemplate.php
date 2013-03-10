<?php

class Controller_Template extends Controller {

    /**
     * @var View
     */
    protected $template;

    /**
     * Подготавливает шаблон
     *
     * @return bool
     */
    public function before($request) {
        $result = parent::before($request);
        $this->template = new View('template');
        return $result;
    }

    /**
     * Заканчивает обработку
     *
     * @return void
     */
    public function after($request) {
        $request->response = $this->template;
        parent::after($request);
    }

}
