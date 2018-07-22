<?php

namespace ishop;

class Error
{
    public function __construct()
    {
        if(DEBUG){
            error_reporting(-1);
        }else{
            error_reporting(0);
        }

        set_exception_handler([$this, "exceptionHandler"]);
    }

    public function exceptionHandler($e){
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayErrors("Исключение", $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logErrors($message = '', $file = '', $line = ''){
        error_log("[" .date('Y-m-d H:i:s'). "] Собшение Ошибки {$message} | Файл {$file} | Строка ошибки {$line} \n==================\n", 3, TMP . "/errors.log");
    }

    protected function displayErrors($errno, $errstr, $errfile, $errline, $response = 404){
        http_response_code($response);
        if($response == 404 && !DEBUG){
            require WWW . "/errors/404.php";
            die();
        }
        if(DEBUG){
            require WWW . "/errors/dev.php";
        }else{
            require WWW . "/errors/prod.php";
        }
        die();
    }
}