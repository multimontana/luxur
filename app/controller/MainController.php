<?php

namespace app\controller;

class MainController extends AppController
{
    public function indexAction(){
        $this->metta['title'] = "Index";
        $this->metta['desc'] = "This is new Page";
        $this->metta['keywords'] = "t-shirt";

        $name = "Tony";
        $surname = "Montana";
        $this->set(compact('name', 'surname'));
    }
}