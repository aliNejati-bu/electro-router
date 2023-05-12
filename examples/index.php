<?php
require "../vendor/autoload.php";

$route = new \Electro\Extra\Router();
$route->get('/',function (){

});
var_dump($route->run($_SERVER['REQUEST_URI']));