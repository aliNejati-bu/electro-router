<?php

namespace Electro\Extra;

use Closure;
use Electro\Extra\Exception\RouteNotFounded;

class Router
{
    /**
     * @var RouteInstance[]
     */
    protected array $routes;

    public string $prefix = '';

    private function addRoute(string $path, string|array|Closure $handler, string $methode, string $name = ""): RouteInstance
    {
        $path = $this->prefix . $path;
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

    public function post(string $path, string|array|Closure $handler, string $name = ''): RouteInstance
    {
        return $this->addRoute(
            $path,
            $handler,
            "POST",
            $name
        );
    }

    public function patch(string $path, string|array|Closure $handler, string $name = ''): RouteInstance
    {
        return $this->addRoute(
            $path,
            $handler,
            "PATCH",
            $name
        );
    }

    public function delete(string $path, string|array|Closure $handler, string $name = ''): RouteInstance
    {
        return $this->addRoute(
            $path,
            $handler,
            "DELETE",
            $name
        );
    }

    public function put(string $path, string|array|Closure $handler, string $name = ''): RouteInstance
    {
        return $this->addRoute(
            $path,
            $handler,
            "PUT",
            $name
        );
    }


    public function run(string $server, string $methode): mixed
    {
        $url = filter_var($server, FILTER_SANITIZE_URL);
        $url = rtrim($url, '/');
        $url = strtok($url, '?');
        $url_parts = explode('/', $url);
        array_shift($url_parts);
        foreach ($this->routes as $route) {
            $route_parts = explode('/', $route->path);
            array_shift($route_parts);
            if ($route_parts[0] == '' && count($url_parts) == 0) {
                return call_user_func($route->handler);
            }
            if (count($route_parts) != count($url_parts) || $route->methode != $methode) {
                continue;
            }
            $params = [];
            $namedParams = [];
            $flag = true;
            for ($__i__ = 0; $__i__ < count($route_parts); $__i__++) {
                $route_part = $route_parts[$__i__];
                if (str_starts_with($route_part, ':')) {
                    $route_part = ltrim($route_part, ':');
                    $params[] = $url_parts[$__i__];
                    $namedParams[$route_part] = $url_parts[$__i__];
                } else if ($route_parts[$__i__] != $url_parts[$__i__]) {
                    $flag = false;
                    break;
                }
            }
            if ($flag) {
                $params[] = $namedParams;
                return call_user_func_array($route->handler, $params);
            }
        }
        return $this->routes;
    }

    /**
     * @throws RouteNotFounded
     */
    public function route(string $name, array $params, string $default = ''): string|bool
    {
        $route = null;
        foreach ($this->routes as $routeInstance) {
            if ($routeInstance->name == $name) {
                $route = $routeInstance;
            }
        }
        if ($route == null) {
            return $default;
        }

        $route_parts = explode('/', $route->path);
        array_shift($route_parts);
        for ($i = 0; $i < count($route_parts); $i++) {
            $route_part = $route_parts[$i];
            if (str_starts_with($route_part, ':')) {
                if (!isset($params[0])) {
                    throw new RouteNotFounded('Route ' . $name . ' Not Founded.');
                }
                $route_parts[$i] = $params[0];
                array_shift($params);
            }
        }
        return '/' . implode('/', $route_parts);
    }
}