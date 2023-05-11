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

    public function __construct(
        string $path,
        string $name,
        string $methode,
    )
    {
        $this->methode = $methode;
        $this->path = $path;
        $this->name = $name;
    }

}