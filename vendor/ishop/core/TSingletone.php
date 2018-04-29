<?php
/**
 * Created by PhpStorm.
 * User: montana
 * Date: 4/28/18
 * Time: 12:41 AM
 */

namespace ishop;


trait TSingletone
{
   private static $instance;

   public static function instance()
   {
      if(self::$instance === null){
          self::$instance = new self();
      }
       return self::$instance;
   }
}