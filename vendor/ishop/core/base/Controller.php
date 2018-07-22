<?php
namespace ishop\base;

abstract class Controller
{
   protected $route;
   protected $controller;
   protected $view;
   protected $prefix;
   protected $model;
   protected $layout;
   protected $data = [];
   protected $metta = [];


   public function __construct($route)
   {
       $this->route = $route;
       $this->controller = $route['controller'];
       $this->view = $route['action'];
       $this->model = $route['controller'];
       $this->controller = $route['controller'];
       $this->prefix = $route['prefix'];
   }

   public function getView(){
       $viewObject = new View($this->route, $this->layout, $this->view, $this->metta);
       $viewObject->render($this->data);
   }

   protected function set($data){
       $this->data = $data;
   }

   protected function setMetta($title = '', $desc = '', $keywords = ''){
       $this->metta['title'] = $title;
       $this->metta['desc'] = $desc;
       $this->metta['keywords'] = $keywords;
    }
}