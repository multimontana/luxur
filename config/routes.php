<?php

use ishop\Router;



Router::add("^$", ["controller" => "Main", "action" => "index"]);
Router::add("^(?<controller>[a-z-]+)/?(?<action>[a-z-]+)?$");
