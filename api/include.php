<?php 
header("Content-Type: text/html; charset=utf8");
date_default_timezone_set("PRC");
session_start();


require_once 'lib/mysql.func.php';
require_once 'lib/upload.func.php';
require_once 'lib/image.func.php';
require_once 'lib/string.func.php';
require_once 'lib/db.pass.php';
connect();
