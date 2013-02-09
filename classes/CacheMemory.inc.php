<?php

class CacheMemory extends Cache {
    protected $connection = null;
    protected $logs = array();

    /**
     * Connect to Memcache server.
     *
     * @param  $options
     * @return void
     */
    public function configure( $options ) {
        $this->connection = memcache_connect($options['host'], $options['port']);
    }

    /**
     * @param  $name
     * @param  $value
     * @param bool $compressed
     * @param int $expire
     * @return void
     */
    public function set( $name, $value, $compressed = false, $expire = 0 ) {
        memcache_set( $this->connection, $name, $value, $compressed, $expire );
    }

    /**
     * @param  $name
     * @return void
     */
    public function get( $name ) {
        $result = memcache_get( $this->connection, $name );
        
        $this->logs[] = array(
            'name' => $name,
            'hit' => $result === FALSE ? '0' : '1',
        );

        return $result;
    }

    /**
     * Удаляет значение из кеша
     *
     * @param $name
     * @return bool
     */
    public function delete( $name ) {
        $result = memcache_delete( $this->connection, $name );

        return $result;
    }

    /**
     * Очищает сервера с кешем
     *
     * @return void
     */
    public function flush() {
        memcache_flush( $this->connection );
    }

    public function showLog() {
        $view = new View('debug/memory');
        $view->logs = $this->logs;

        echo $view;
    }
}