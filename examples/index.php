<?php
require "../vendor/autoload.php";

$route = new \Electro\Extra\Router();




echo $route->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);