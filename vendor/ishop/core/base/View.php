<?php

namespace ishop\base;


class View
{
    protected $route;
    protected $controller;
    protected $view;
    protected $prefix;
    protected $model;
    protected $layout;
    protected $data = [];
    protected $metta = [];


    public function __construct($route, $layout = '', $view = '', $metta)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $view;
        $this->model = $route['controller'];
        $this->controller = $route['controller'];
        $this->prefix = $route['prefix'];
        $this->metta = $metta;

        if($layout === false){
            $this->layout = false;
        }else{
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data){
        if(is_array($data)) extract($data);
        $view = APP . "/{$this->prefix}{$this->controller}/{$this->view}.php";
        if(file_exists($view)){
            ob_start();
            require_once $view;
            $content = ob_get_clean();
        }else{
            throw new \Exception("Страница не найдена", 404);
        }

        if(false !== $this->layout){
            $layout = APP . "/layouts/{$this->layout}.php";
            if(file_exists($layout)){
                require_once $layout;
            }else{
                throw new \Exception("Страница не найдена", 404);
            }
        }else{
            throw new \Exception("Не найден шаблон",500);
        }
    }

    public function getMetta(){
        $output = "<title>{$this->metta['title']}</title>" . PHP_EOL;
        $output .= "<metta name='description' content='{$this->metta['desc']}'></metta>" . PHP_EOL;
        $output .= "<metta name='keywords' content='{$this->metta['keywords']}'></metta>" .PHP_EOL;
        return $output;
    }
}