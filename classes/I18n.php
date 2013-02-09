<?php

class I18n {
    public static $lang = 'en';
    public static $messages = array();

    /**
     * Returns translation of a string. If no translation exists, the original string will be returned.
     * No parameters are replaced.
     *
     *
     */
    public static function get( $string, $lang = null ) {
        $result = $string;

        if ( empty($lang) ) {
            $lang = self::lang();
        }

        $messages = self::$messages[$lang];

        $parts = explode('.', $string);
        foreach($parts as $part) {
            $messages = $messages[$part];
        }

        if ( is_string( $messages ) ) {
            $result = $messages;
        }

        return $result;
    }	

    /**
     * Get and set the target language.
     *
     *
     */
    public static function lang( $lang = null ) {

        if ( !is_null($lang) && isset(self::$messages[$lang]) ) {
            self::$lang = $lang;
        }

        return self::$lang;
    }

    /**
     * Returns the translation table for a given language.
     *
     */
    public static function load( $lang ) {
        $result = include 'i18n'.'/'.$lang.'.php';

        self::$messages[$lang] = $result;

        return $result;
    }

}

// Default init

I18n::load( 'en' );
