<?php
session_start() ; 
include_once("../app/configuration/functions.php") ; 
include_once("../app/controllers/navbar.php") ; 
$routes = include_once("../app/configuration/routes.php");

define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));

run($_SERVER['REQUEST_URI'] , $routes) ; 




?>