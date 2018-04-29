<?php

namespace ishop;


class Router
{
  protected static $routes = [];
  protected static  $route = [];

  public static function add($regexp, $route = []){
      self::$routes[$regexp] = $route;
  }

  public static function getRotes(){
      return self::$routes;
  }

  public static function getRoute(){
      return self::$route;
  }

  public static function dispatch($url){
      $url = self::removeQueryString($url);
      if(self::matchRouter($url)){
          $controller = "app\controllers\\" . self::$route["prefix"] . self::$route["controller"] .
              "Controller";
          if(class_exists($controller)){
               $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . "Action";
                if(method_exists($controllerObject, $action)){
                    $controllerObject->$action();
                    $controllerObject->getView();
                }else{
                    throw new \Exception("Контролер $controller::$action не найдена",404);
                }
          }else{
              throw new \Exception("Контролер $controller не найдена",404);
          }
      }else{
          throw new \Exception("Страница не найдена",404);
      }
  }

  public static function matchRouter($url){
      foreach (self::$routes as $pattern => $route){
          if(preg_match("#{$pattern}#", $url, $matches)) {
              foreach ($matches as $k => $v){
                  if(is_string($k)){
                      $route[$k] = $v;
                  }
              }
              if(empty($route["action"])){
                  $route['action'] = "index";
              }
              if(!isset($route["prefix"])){
                  $route["prefix"] = "";
              }else{
                  $route["prefix"] .= "\\";
              }
              $route["controller"] = self::upperCamelCase($route["controller"]);
              self::$route = $route;
              return true;
          }
      }
      return false;
  }

  protected static function upperCamelCase($name){
      return str_replace(" ", "",ucwords(str_replace("-", " ", $name)));
  }

  protected static function lowerCamelCase($name){
      return lcfirst(self::upperCamelCase($name));
  }

  protected static function removeQueryString($url){
      if($url){
          $params = explode("?", $url, 2);
          if(false === strpos($params[0], "=")){
              return rtrim($params[0], "/");
          }else{
              return '';
          }
      }
  }

}