<?php

const DEBUG = 1;
define("ROOT", dirname(__DIR__));
const CONFIG = ROOT . "/config";
const APP = ROOT ."/app/views";
const WWW = ROOT . "/public";
const TMP = ROOT . "/tmp";
const CACHE = ROOT . "/tmp/cache";
const VENDOR = ROOT . "/vendor";
const CORE = VENDOR . "/ishop/core";
const BASE = CORE . "/base";
const LIBS = CORE . "/libs";
const LAYOUT = "default";

require_once VENDOR  . "/autoload.php";