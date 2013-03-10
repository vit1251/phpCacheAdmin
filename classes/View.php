<?php

define('VIEW_PATH', dirname(__FILE__) . '/../views/');

class View {

    /**
     *
     * @var string
     */
    protected $_file;

    /**
     * Array of local variables
     *
     * @var array
     */
    protected $_data = array();

    /**
     * Конструктор для создания представления
     *
     * @param string $name имя файла шаблона
     * @return void
     */
    public function __construct($name) {
        $this->_file = VIEW_PATH . $name . '.php';
    }

    /**
     * Захватывает вывод сгенерированный когда происходит включение представления.
     *
     * @param string $filename
     * @param array $variables
     * @return string
     */
    protected static function capture($view_filename, array $view_data) {

        extract($view_data, EXTR_SKIP);
        
        try {
            ob_start();
            include $view_filename;
            $result = ob_get_clean();
        } catch (Exception $e) {
            ob_end_clean();
            throw $e;
        }

        return $result;
    }

    /**
     * Устанавливает значение переменной
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value = null) {
        $this->_data[$key] = $value;
    }

    /**
     * Magic method, searches for the given variable and returns its value.
     * Local variables will be returned before global variables.
     *
     *     $value = $view->foo;
     *
     * [!!] If the variable has not yet been set, an exception will be thrown.
     *
     * @param   string  variable name
     * @return  mixed
     * @throws  Kohana_Exception
     */
    public function & __get($key) {
        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        } else {
            throw new Exception('View variable is not set: :var', array(':var' => $key));
        }
    }

    /**
     * Magic method, calls [View::set] with the same parameters.
     *
     *     $view->foo = 'something';
     *
     * @param   string  variable name
     * @param   mixed   value
     * @return  void
     */
    public function __set($key, $value) {
        $this->set($key, $value);
    }

    /**
     * Магический метод, возвращает вывод метода [View::render].
     *
     * @return string
     * @uses View::render
     */
    public function __toString() {
        $result = $this->render();

        return $result;
    }


    /**
     * Производить рендеринг представления
     *
     * @throws Exception
     * @param string $file имя файла шаблона для рендеринга
     * @return string
     */
    public function render($file = null) {
        if (!is_null($file)) {
            $this->_file = VIEW_PATH . $file . '.php';
        }

        if (empty($this->_file)) {
            throw new Exception('You must set the file to use within your view before rendering');
        }

        return View::capture($this->_file, $this->_data);
    }

}
