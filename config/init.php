<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . "/public");
define("APP", ROOT . "/app");
define("CACHE", ROOT . "/tmp/cache");
define("CORE", ROOT . "/vendor/ishop/core");
define("LIBS", ROOT . "/vendor/ishop/core/libs");
define("BASE", ROOT . "/vendor/ishop/core/base");
define("CONF", ROOT . "/config");
define("LAYOUT", "default");


require_once ROOT . "/vendor/autoload.php";