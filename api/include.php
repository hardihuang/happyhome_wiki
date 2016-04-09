<?php 
header("Content-Type: text/html; charset=utf8");
date_default_timezone_set("PRC");
session_start();

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PWD","");
define("DB_DBNAME","hh_wiki");
define("DB_CHARSET","utf8");

require_once 'lib/mysql.func.php';
require_once 'lib/upload.func.php';
require_once 'lib/image.func.php';
require_once 'lib/string.func.php';
connect();
