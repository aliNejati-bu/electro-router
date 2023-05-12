<?php

namespace Electro\Extra;

use Closure;

class RouteInstance
{
    /**
     * @var string route path
     */
    public string $path;

    /**
     * @var string route name
     */
    public string $name;

    /**
     * @var string methode post|get|put|delete|patch
     */
    public string $methode;

    /**
     * @var string|array|Closure
     */
    public string|array|Closure $handler;

    /**
     * @param string $path
     * @param string $name
     * @param string $methode
     */
    public function __construct(
        string               $path,
        string               $methode,
        string|array|Closure $handler,
        string               $name = "",
    )
    {
        $this->methode = $methode;
        $this->path = $path;
        $this->name = $name;
        $this->handler = $handler;
    }

    /**
     * @var Closure[]
     */
    public array $middlewares = [];

    /**
     * @param string $name
     * @return RouteInstance
     */
    public function name(string $name): RouteInstance
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param Closure[] $m
     * @return RouteInstance
     */
    public function addMiddlewares(array $m): RouteInstance
    {
        $this->middlewares = array_merge($this->middlewares, $m);
        return $this;
    }

}