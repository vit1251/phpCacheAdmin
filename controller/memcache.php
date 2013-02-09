<?php

class Controller_Memcache extends Controller {

    /**
     * Указывает на обьект с кешем
     *
     * @var CacheMemory
     */
    protected $cache;

    /**
     * Перед каждым обращением к контроллеру устанавливаем подключение к серверу
     * 
     * @return void
     */
    public function before() {

        $this->cache = new CacheMemoryCollect();

        $servers = Config::get('memcache');
        $configuration = Session::instance()->configuration;
        $server_id = $configuration['server_id'];

        $options = array(
            'host'    => $servers[$server_id]['host'],
            'port'    => $servers[$server_id]['port'],
            'timeout' => $servers[$server_id]['timeout'],
        );

        $this->cache->configure( $options );

        return parent::before();
    }

    /**
     * Информация о сервере
     *
     * @return void
     */
    public function status() {
        $template = new View( 'template' );
        $template->content = new View( 'stats' );
        $template->content->info = $this->cache->info();

        echo $template;
    }

    /**
     * Основная информация
     *
     * @return void
     */
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
