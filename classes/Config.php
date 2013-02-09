<?php

class Config {

    protected static $configs = array();

    /**
     *
     *
     */
    public static function get( $string ) {

        $result = self::$configs;

        $parts = explode('.', $string);
        foreach($parts as $part) {
            $result = $result[$part];
        }

        return $result;
    }	

    /**
     * Returns the translation table for a given language.
     *
     */
    public static function load( $config ) {
        $result = false;

        $file = 'config'.'/'.$config.'.php';
        if ( file_exists($file) ) {
            self::$configs[$config] = include $file;
            $result = true;
        }

        return $result;
    }



}

