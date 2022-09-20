<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("'Access-Control-Allow-Methods: *");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Europe/Bucharest');
define('HOST',   "localhost");
define('DB',   "proiect"); 
define('DBUSER',   "proiect");
define('DBPASSWORD',   "12345678");
define('SQL_CONNECTION_OFF',   "Nu există conexiune la baza de date.");
?>