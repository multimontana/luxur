<?php

require_once dirname(__DIR__) . "/config/init.php";
require_once LIBS . "/functions.php";
require CONF ."/routes.php";

new \ishop\App();
new \ishop\Router();

