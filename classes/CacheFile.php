<?php

/**
 * Реализация работы с файловым кешем
 *
 */
class CacheFile extends Cache {
    protected static $path = 'cache/data';
    protected $logs = array();

    /**
     * Сохраняем элемент в кеше
     *
     * @param string $name
     * @param mixed $value
     * @param bool $compressed
     * @param int $expire
     * @return void
     */
    public function set( $name, $value, $compressed = false, $expire = 0 ) {
        $filename = self::$path . DIRECTORY_SEPARATOR . md5( $name );

        $cacheObject             = new stdClass();
        $cacheObject->name       = $name;
        $cacheObject->expire     = time() + $expire;
        $cacheObject->compressed = $compressed;
        $cacheObject->data       = $value;

        file_put_contents($filename, serialize($cacheObject) );
    }

    /**
     * Получаем элемент из кеша
     *
     * @param string $name
     * @return bool|mixed|string
     */
    public function get( $name ) {
        $result = false;

        $filename = self::$path . DIRECTORY_SEPARATOR . md5( $name );
        if ( file_exists($filename) ) {
            $content     = file_get_contents( $filename );
            $cacheObject = unserialize( $content );
             
            /* Если данные не просрочены */
            if ( $cacheObject->expire > time() ) {
                $result = $cacheObject->data;
            } else {
                @unlink($filename);
            }
        }

        $this->logs[] = array(
            'name' => $name,
            'hit' => $result === FALSE ? '0' : '1',
        );

        return $result;
    }

    /**
     * Удаляет значение из кеша
     *
     * @param string $name
     * @return bool
     */
    public function delete( $name ) {
        $result = false;

        $filename = self::$path . DIRECTORY_SEPARATOR . md5( $name );
        if ( file_exists($filename) ) {
            @unlink( $filename );
            $result = true;
        }

        return $result;
    }

    public function showLog() {
        $view = new View('debug/memory');
        $view->logs = $this->logs;

        echo $view;
    }

}