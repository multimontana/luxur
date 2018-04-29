<?php
/**
 * Created by PhpStorm.
 * User: montana
 * Date: 4/29/18
 * Time: 10:35 PM
 */

namespace ishop\base;


class VIew
{

    public $route;
    public $controller;
    public $view;
    public $model;
    public $layout;
    public $prefix;
    public $data = [];
    public $meta = [];


    public function __construct($route, $layout, $view, $meta)
    {
        $this->route = $route;
        $this->controller = $route["controller"];
        $this->view = $route["action"];
        $this->model = $route["controller"];
        $this->prefix = $route["prefix"];
        $this->layout = $layout;
        $this->view  = $view;
        $this->meta = $meta;
        if($layout === false){
            $this->layout = false;
        }else{
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data){
        if(is_array($data)){
            extract($data);
        }
        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";

        if(file_exists($viewFile)){
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        }else{
            throw new \Exception("Данного файла не существут", 404);
        }

        $layoutFile = APP . "/views/layouts/{$this->layout}.php";

        if(file_exists($layoutFile)){
            require_once $layoutFile;
        }else{
            throw new \Exception("Данного файла не существут", 404);
        }

    }

    public function getMeta(){
        $output = "<title>{$this->meta['title']}</title>" . PHP_EOL;
        $output .= "<meta name='description' content='{$this->meta['desc']}'>" . PHP_EOL;
        $output .= "<meta name='keyword' content='{$this->meta['keywords']}'>" . PHP_EOL;
        return $output;
    }

}