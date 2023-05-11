<?php

namespace Electro\Extra;

class Router
{
    /**
     * @var RouteInstance[]
     */
    protected array $routes;

    /**
     * @param string $path
     * @param string $methode
     * @param string $name
     * @return RouteInstance
     */
    private function addRoute(string $path, string $methode, string $name = ""): RouteInstance
    {
        return new RouteInstance(
            $path,
            $methode,
            $name,
        );
    }

    public function get(string $path, string $name = ''): RouteInstance
    {
        return $this->addRoute(
            $path,
            "GET",
            $name
        );
    }
}