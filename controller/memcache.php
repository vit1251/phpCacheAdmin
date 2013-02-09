<?php

class Controller_Memcache {
    protected $cache;

    public function __construct() {

        $this->cache = new CacheMemoryCollect();

        $options = array(
            'host' => Config::get('memcache.host'),
            'port' => Config::get('memcache.port'),
        );

        $this->cache->configure( $options );
    }

    public function stats() {
        $template = new View( 'template' );
        $template->content = new View( 'stats' );
        $template->content->info = $this->cache->info();

        echo $template;
    }

    public function index() {

        $template = new View( 'template' );
        $template->content = new View( 'collect' );
        $template->content->collect = $this->cache->collect();

        echo $template;
    }

    public function view() {
        $template = new View( 'template' );
        $template->content = $view = new View('view');

        $name = $_REQUEST['name'];

        $view->title = $name;
        $view->data = $this->cache->get($name);

        echo $template;
    }

    public function collect() {
        $collect = $this->cache->collect();

        foreach ($collect as $record) {
            if ( $record['timeout'] < 0 ) {
                $this->cache->delete( $record['name'] );

                $gc[] = $record;
            }
        }

        $template = new View( 'template' );
        $template->content = $view = new View( 'collect' );
        $view->collect = $gc;

        echo $template;
    }
 
    public function delete() {
        $name = $_REQUEST['name'];

        $result = $this->cache->delete($name);

        echo json_encode( $result );
    }

}
