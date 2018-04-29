<?php
/**
 * Created by PhpStorm.
 * User: montana
 * Date: 4/29/18
 * Time: 9:29 PM
 */

namespace app\controllers;


use ishop\Cache;
use RedBeanPHP\R;
use function Sodium\compare;

class MainController extends AppController
{
   public function indexAction(){
        $posts = R::findAll('test');
        $this->setMeta("My new web Site", "This is realy nicer site", "hello");
        $name = "Tony";
        $cache = Cache::instance();
       $data = $cache->get("test");
       if(!$data){
           $cache->set("test", $name);
       }
       debug($data);
       $this->set(compact('posts'));
   }
}