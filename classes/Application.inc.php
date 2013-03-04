<?php

class Application {

    public static function createApplication() {
        return new Application();
    }

    public function run() {
        Config::load('memcache');
        Config::load('i18n');
        Config::load('routes');
        $lang = Config::get('i18n.lang');
        I18n::load( $lang );
        I18n::lang( $lang );
        session_start();
        echo Request::instance()
            ->load()
            ->execute()
            ->response;
    }

}
