<?php

namespace ishop;

class Router
{
   protected static $routes = [];
   protected static $route = [];


   public static function add($regexp, $route = []){
       self::$routes[$regexp] = $route;
   }

   public static function getRoutes(){
       return self::$routes;
   }

   public static function getRoute(){
       return self::$route;
   }

   public static function dispatch($query){
        if(self::matchRoutes($query)){
           $controller = "\app\controller\\" . self::$route['prefix'] . self::upperCamelCase(self::$route['controller']) . "Controller";
           if(class_exists($controller)){
               $controllerObject = new $controller(self::$route);
               $action = self::lowwerCamleCase(self::$route['action']) . "Action";
               if(method_exists($controllerObject, $action)){
                   $controllerObject->$action();
                   $controllerObject->getView();
               }else{
                   throw new \Exception("Метод {$controller}::{$action} не найден", 404);
               }
           }else{
               throw new \Exception("Контроллер {$controller} не найден", 404);
           }
        }else{
            throw new \Exception("Страница не найдена", 404);
        }
   }
   public static function matchRoutes($query){
      foreach (self::$routes as $pattern => $route){
          if(preg_match("#{$pattern}#", $query, $newMattches)){
              foreach ($newMattches as $k => $v){
                  if(is_string($k)){
                      $route[$k] = $v;
                  }
              }
              if(empty($route['action'])){
                  $route['action'] = 'index';
              }
              if(!isset($route['prefix'])){
                  $route['prefix'] = '';
              }else{
                  $route['prefix'] .= "\\";
              }
              self::$route = $route;
              return true;
          }
      }
      return false;
   }

    /**
     * return NewController
     * @param $name
     *
     */
   protected static function upperCamelCase($name){
       return str_replace(" ",  "", ucwords(str_replace("-", " ", $name)));
   }

    /**
     * return newAction
     * @param $anme
     */

   protected static function lowwerCamleCase($name){
       return lcfirst(self::upperCamelCase($name));
   }
}