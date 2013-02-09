<?php

class CacheFileCollect extends CacheFile {

    /**
     * Принудительно запускает сборку мусора
     *
     * @return array
     */
    public function collect() {
        $result = array();

        if ($dh = opendir(self::$path)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != '.' && $file != '..') {
                    $filename = self::$path . DIRECTORY_SEPARATOR . $file;
                    $content = file_get_contents($filename);
                    $cacheObject = unserialize($content);

                    $result[$file]['name'] = $cacheObject->name;
                    $result[$file]['compressed'] = $cacheObject->compressed;
                    $result[$file]['expire'] = $cacheObject->expire;
                    $result[$file]['timeout'] = $cacheObject->expire - time();
                    $result[$file]['size'] = strlen( $cacheObject->data );
                }
            }
            closedir($dh);
        }
        return $result;
    }

}