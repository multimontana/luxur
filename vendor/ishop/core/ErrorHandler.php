<?php

namespace ishop;


class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            ini_set('display_errors', 1);
            error_reporting(1);
        } else {
            error_reporting(0);
        }

        set_exception_handler([$this, 'exceptionHandler']);
    }


    public function exceptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError("Исключение", $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logErrors($message = '', $file = '', $line = '')
    {
        error_log("[" . date("Y-m-d") . "] | Текст Ошибки: {$message} 
       | Путь к Файлу: {$file} | Строка Ошибки: {$line} \n===================\n",
            3, ROOT . "/tmp/errors.log");
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $response = 404)
    {
        http_response_code($response);

        if ($response == 404 && !DEBUG) {
            require WWW . "/errors/404.php";
            die();
        }

        if (DEBUG) {
            require WWW . "/errors/dev.php";

        } else {
            require WWW . "/errors/prod.php";
        }
        die();
    }

}