<?php

class Response {

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
     * @var  array  headers to send with the response body
     */
    public $headers = array();

    /**
     * @var  string  response body
     */
    public $response;

    /**
     * @var integer Код HTTP ответа: 200, 404, 500...
     */
    public $status = 200;

    public function __construct($response = '') {
        $this->response = $response;
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

    public function setCode($code) {
        $this->status = $code;
    }

}
