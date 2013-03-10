<?php

abstract class Cache {
    protected $cache = array();

    /**
     * Конфигурирование
     *
     * @param array $options
     * @return void
     */
    public function configure( $options ) {
    }

    /**
     * Сохраняем значение в кеш
     *
     * @param  $name
     * @param  $value
     * @return bool
     */
    public function set( $name, $value ) {
        $this->cache[$name] = $value;
    }

    /**
     * Получение значения из кеша
     *
     * @param  $name
     * @return
     */
    public function get( $name ) {
        $result = false;
        if ( isset($this->cache[$name]) ) {
            $result = $this->cache[$name];
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function flush() {
        return false;
    }

}
