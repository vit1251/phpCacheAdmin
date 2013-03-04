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

        $options = array(
            'host'    => $_SESSION['host'],
            'port'    => $_SESSION['port'],
            'timeout' => $_SESSION['timeout'],
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

        if (array_key_exists('key', $_REQUEST)) {
            $key = $_REQUEST['key'];

            $view->title = $key;
            $view->data = $this->cache->get($key);
        }

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
