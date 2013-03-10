<?php

class Application {

    protected function __construct() {
    }

    public static function createApplication() {
        return new Application();
    }

    /**
     * Выполняет действие из контроллера
     *
     * @param Request $request
     * @return Response
     */
    public function execute($request) {

        $className = 'Controller' . '_' . ucfirst($request->controller);
        $class = new $className;
        $response = $class->serve($request);
        
        return $response;
    }

    public function run() {
        Config::load('memcache');
        Config::load('i18n');
        Config::load('routes');

        $lang = Config::get('i18n.lang');

        I18n::load( $lang );
        I18n::lang( $lang );

        session_start();

        $request = new Request();

        $response = $this->execute($request);
        $response->send_headers();
        echo $response;
    }

}
