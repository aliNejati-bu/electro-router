<?php

namespace Electro\Extra;

use Closure;

class Router
{
    /**
     * @var RouteInstance[]
     */
    protected array $routes;


    private function addRoute(string $path, string|array|Closure $handler, string $methode, string $name = ""): RouteInstance
    {
        $i = new RouteInstance(
            $path,
            $methode,
            $handler,
            $name,
        );
        $this->routes[] = $i;
        return $i;
    }

    public function get(string $path, string|array|Closure $handler, string $name = ''): RouteInstance
    {
        return $this->addRoute(
            $path,
            $handler,
            "GET",
            $name
        );
    }

    public function post(string $path, string|array $handler, string $name = ''): RouteInstance
    {
        return $this->addRoute(
            $path,
            $handler,
            "POST",
            $name
        );
    }

    public function run(string $server): mixed
    {
        $url = filter_var($server, FILTER_SANITIZE_URL);
        $url = rtrim($url, '/');
        $url = strtok($url, '?');
        $url_parts = explode('/', $url);
        array_shift($url_parts);
        foreach ($this->routes as $route) {
            $route_parts = explode('/', $route->path);
        }
        return $this->routes;
    }

}