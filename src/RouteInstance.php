<?php

namespace Electro\Extra;

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
     * @param string $path
     * @param string $name
     * @param string $methode
     */
    public function __construct(
        string $path,
        string $methode,
        string $name = "",
    )
    {
        $this->methode = $methode;
        $this->path = $path;
        $this->name = $name;
    }

    /**
     * @param string $name
     * @return RouteInstance
     */
    public function name(string $name): RouteInstance
    {
        $this->name = $name;
        return $this;
    }

}