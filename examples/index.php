<?php
require "../vendor/autoload.php";

$route = new \Electro\Extra\Router();


$route->get('/', function () use ($route) {
    return $route->route('test', ['zdnthn']);
});

$route->post('/:app/test', function () {

})->name('test');

echo $route->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);