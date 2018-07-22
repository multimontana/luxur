<?php
namespace ishop;
class App
{
   public static $app;
   public function __construct()
   {
       $query = trim($_SERVER["REQUEST_URI"], "/");
       session_start();
       self::$app = Registry::instance();
       $this->getParams();
       new Error();
       Router::dispatch($query);
   }

   public function getParams(){
       $params = require_once CONFIG . "/params.php";
       if(isset($params)){
           foreach ($params as $k => $v){
               self::$app->setProperty($k, $v);
           }
       }
   }
}