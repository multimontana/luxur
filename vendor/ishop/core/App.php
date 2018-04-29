<?php
/**
 * Created by PhpStorm.
 * User: montana
 * Date: 4/28/18
 * Time: 12:16 AM
 */

namespace ishop;


class App
{
   public static $app;

   public function __construct()
   {
       $query = trim($_SERVER["REQUEST_URI"], "/");
       session_start();
       self::$app = Register::instance();
       $this->getParams();
       new ErrorHandler();
       Router::dispatch($query);
   }

   protected function getParams(){
       $params = require_once CONF . "/params.php";
       if(!empty($params)){
           foreach ($params as $k => $v) {
              self::$app->setProperty($k, $v);
           }
       }
   }
}