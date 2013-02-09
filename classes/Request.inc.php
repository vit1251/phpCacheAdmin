<?php

class Request {

    // HTTP status codes and messages
    public static $messages = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Large',
        415 => 'Unsupported Media Type',
        416 => 'Requested range not satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out'
    );

    /**
     * Возвращает синглетон обьекта Request
     *
     * @static
     * @return Request
     */
    public static function instance() {
        static $instance;
        if (!is_object($instance)) {
            $instance = new self;
        }
        return $instance;
    }

    /**
     * @var integer Код HTTP ответа: 200, 404, 500...
     */
    public $status = 200;

    /**
     * @var  array  headers to send with the response body
     */
    public $headers = array();

    /**
     * @var  string  response body
     */
    public $response = '';

    /**
     * @var  string  controller to be executed
     */
    public $controller = 'welcome';

    /**
     * @var  string  action to be executed in the controller
     */
    public $action = 'index';

	/**
	 * @var array параметры для вывода
	 */
	protected $args = array();

    /**
     * Конструктор
     *
     * @params string $uri
     * @return void
     */
    private function __construct( $uri = null ) {
        if ( empty( $uri ) ) {
            $uriArr = explode('?', $_SERVER['REQUEST_URI'], 2);
            $uri = $uriArr[0];
            $query  = !empty($uriArr[1]) ? $uriArr[1] : '';
        }

        $this->uri = $uri;

        $urlconf = Config::get('routes');

        foreach ($urlconf as $pattern => $callback) {
            if (preg_match($pattern, $this->uri, $matches) != false) {
                $this->controller = $callback[0];
                if (isset($matches['action'])) { // если задан экшн
                    $this->action = $matches['action'];
                    $this->args = !empty($matches[2]) ? explode('/', $matches[2]) : array();
                } else {
                    if (!isset($callback[1])) {
                        $this->status = 404;
                    }
                    $this->action = $callback[1]; // берем дефолтный экшн
                    array_shift($matches);
                    $this->args = $matches;
                }

                break;
            }
        }

    }
    
    /**
     * Returns the response as the string representation of a request.
     *
     *     echo $request;
     *
     * @return  string
     */
    public function __toString() {
        return (string) $this->response;
    }

    /**
     * Осуществляет иерархическую загрузку классов контроллера
     *
     * @return $this
     */
    public function load() {

        /* Если название контроллера пустое, то выходим */
        if ( empty($this->controller) ) {
            return $this;
        }

        /* Создаем список необходимых для работы контроллеров */
        $controllers = array();
        $controller = '';
        $parts = explode('_', $this->controller);
        foreach( $parts as $part ) {
            if ( !empty($controller) ) {
                $controller = $controller . '/' . $part;
            } else {
                $controller = $part;
            }

            $controllers[] = $controller;
        }

        /* Загружаем каждый контроллер */
        foreach ( $controllers as $controller ) {
            $controller_path = 'controller' . '/' . $controller . '.php';

            if (file_exists($controller_path)) {
                include $controller_path;
            }
            else {
                error_log('loading '.$controller_path.' fail.' );
            }
        }

        return $this;
    }

    /**
     * Отправляет код ответа и все заголовки.
     *
     * @return $this
     * @uses Request::$messages
     */
    public function send_headers() {
       
        $headers_sent = headers_sent();

        if ( !$headers_sent ) {
            if (isset($_SERVER['SERVER_PROTOCOL'])) {
                // Use the default server protocol
                $protocol = $_SERVER['SERVER_PROTOCOL'];
            } else {
                // Default to using newer protocol
                $protocol = 'HTTP/1.1';
            }

            // HTTP status line
            header($protocol . ' ' . $this->status . ' ' . self::$messages[$this->status]);
            //echo $protocol . ' ' . $this->status . ' ' . Request::$messages[$this->status];

            foreach ($this->headers as $name => $value) {
                if (is_string($name)) {
                    // Combine the name and value to make a raw header
                    $value = "{$name}: {$value}";
                }

                // Send the raw header
                header($value, true);
            }
        }
        else
        {
            throw new Exception('Невозможно отправить заголовки');
        }

        return $this;
    }

    /**
     * Обеспечивает перенаправление на заданный URL
     *
     * @param mixed $url
     * @param integer $status
     * @param boolean $exit
     * @return void
     */
    public function redirect($url, $status = 301, $exit = true) {
        if (strpos($url, '://') === false) {
            // Make the URI into a URL
        }

        // Set the response status
        $this->status = $status;

        // Set the location header
        $this->headers['Location'] = $url;

        // Send headers
        $this->send_headers();

        // Stop execution
        exit;
    }

    /**
     * Выполняет действие из контроллера
     *
     * @return $this
     */
    public function execute() {

        $className = 'Controller' . '_' . ucfirst($this->controller);

        if (!class_exists($className, false)) {
            throw new Exception( 'Невозможно найти необходимый класс ' . $className );
        }

        $class = new $className;

        if ( !method_exists($className, $this->action ) ) {
            throw new Exception( 'Не существует метода для обработки запроса ' . $this->action );
        }

        call_user_func( array($class, 'before') );
        call_user_func( array($class, $this->action) );
        call_user_func( array($class, 'after') );
        
        return $this;
    }

}
