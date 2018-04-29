<?php

namespace ishop\base;


use ishop\Db;

class Model
{
  public $attributes = [];
  public $errors = [];
  public $rules = [];

  public function __construct()
  {
      Db::instance();
  }
}