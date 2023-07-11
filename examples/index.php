<?php
require "../vendor/autoload.php";

$route = new \Electro\Extra\Router();


$route->post('/', function () {
    return "index";
})->addMiddlewares([
    function () {
        return true;
    }
]);

$route->get("/app/:id", function ($id) {
    return $id;
})->name('id');

$route->get("/redirect", function () use ($route) {
    header('Location: ' . $route->route('id', ["55"]));
});

$route->group('/api', function (\Electro\Extra\Router $router) {

    $router->get('/', function () {
        return 'in api group.';
    });
});

$route->set404(function () {
    return "404";
});

echo $route->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);