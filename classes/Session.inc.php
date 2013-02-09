<?php

class Session {

    /**
     * Возвращает синглетон
     *
     * @static
     * @return Session
     */
    public static function instance() {
        static $instance;
        if (!is_object($instance)) {
            $instance = new self;
        }
        return $instance;
    }

    /**
     * Возвращает значение из сессии
     *
     * @param string $name
     * @return mixed
     */
    public function __get( $name ) {
        $result = null;
        if ( isset($_SESSION[$name]) ) {
            $result = $_SESSION[$name];
        }
        return $result;
    }

    /**
     * Сохраняет значение в сессии
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set( $name, $value ) {
        $_SESSION[$name] = $value;
    }

}

session_start();

