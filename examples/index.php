<?php
require "../vendor/autoload.php";

$route = new \Electro\Extra\Router();


$route->get('/', function () {
    return "index";
});

$route->get("/app/:id", function ($id) {
    return "id";
})->name('id');

$route->get("/redirect", function () use ($route) {
    header('Location: ' . $route->route('id', ["12"]));
});

$route->set404(function () {
    return "404";
});

echo $route->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);