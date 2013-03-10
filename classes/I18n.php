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
    public static function get( $path, $lang = null ) {
        $result = '&lt;' . $path . '&gt;';

        if ( empty($lang) ) {
            $lang = self::lang();
        }

        if (array_key_exists($lang, self::$messages)) {
            $messages = self::$messages[$lang];
            if (array_key_exists($path, $messages)) {
                $result = is_string($messages[$path]) ? $messages[$path] : '!not_a_string!';
            }
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
     * @return null|array
     */
    public static function load( $lang ) {
        $result = null;
        $resourceLangPath = dirname(__FILE__) . '/../i18n/' . $lang . '.php';
        if (file_exists($resourceLangPath)) {
            $result = include $resourceLangPath;
            self::$messages[$lang] = $result;
        }
        return $result;
    }

}

// Default init

I18n::load( 'en' );
