<?php

namespace ishop;
use \RedBeanPHP\R as R;

class Db
{
    use TSingletone;

    /**
     * Db constructor.
     */
    protected function __construct()
  {
      $db = require_once  CONF . "/config_db.php";
      R::setup($db['dsn'], $db['user'], $db['password']);
      if(!R::testConnection()){
          echo "Error";
      }

      R::freeze( TRUE );

      if(DEBUG){
          R::debug(true, 1);
      }
  }
}