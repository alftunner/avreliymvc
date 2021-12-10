<?php

define('DEDUG', 1);

/**
 * Класс для обработки различных ошибок и исключений
 */
class ErrorHandler {

    public function __construct() {
        if (DEDUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);
    }

    /**
     * Метод для обрабоки НЕ фатальных ошибок
     * @param $errno
     * @param $errstr
     * @param $errfile
     * @param $errline
     * @return bool
     */
    public function errorHandler($errno, $errstr, $errfile, $errline) {
        error_log('[' . date("Y-m-d H:i:s") . '] Текст ошибки: ' . $errstr . ' | В файле - ' . $errfile
            . ' | Строка ' . $errline . "\n" . '===================================' . "\n", 3, __DIR__ . '/errors.log');
        $this->displayError($errno, $errstr, $errfile, $errline);
        return true;
    }

    /**
     * Метод для обрабоки фатальных ошибок
     */
    public function fatalErrorHandler() {
        $error = error_get_last();
        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            error_log('[' . date("Y-m-d H:i:s") . '] Текст ошибки: ' . $error['message'] . ' | В файле - ' . $error['file']
                . ' | Строка ' . $error['line'] . "\n" . '===================================' . "\n", 3, __DIR__ . '/errors.log');
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }

    /**
     * Метод для обработки исключений
     * @param Exception $e
     */
    public function exceptionHandler(Exception $e) {
        error_log('[' . date("Y-m-d H:i:s") . '] Текст ошибки: ' . $e->getMessage() . ' | В файле - ' . $e->getFile()
            . ' | Строка ' . $e->getLine() . "\n" . '===================================' . "\n", 3, __DIR__ . '/errors.log');
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }


    /**
     * Метод для подключения шаблона вывода ошибок
     * @param $errno
     * @param $errstr
     * @param $errfile
     * @param $errline
     * @param int $response
     */
    protected function displayError($errno, $errstr, $errfile, $errline, $response = 500) {
        http_response_code($response);
        if (DEDUG) {
            require 'views/dev.php';
        } else {
            require 'views/prod.php';
        }
    }
}

new ErrorHandler();
throw new Exception('Hello');
