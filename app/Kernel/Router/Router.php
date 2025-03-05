<?php
namespace App\Kernel\Router;


use App\Kernel\Router\RouteConfiguration;

class Router
{
    private static array $getRoutes = [];
    private static array $postRoutes = [];

    public static function get(string $route, array $controller) : RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$getRoutes[] = $routeConfiguration;
        
        return $routeConfiguration;
    }

    public static function post(string $route, array $controller) : RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$postRoutes[] = $routeConfiguration;
        
        return $routeConfiguration;
    }

    public static function getRoutesGet() :array
    {
        return self::$getRoutes;
    }

    public static function getRoutesPost(): array
    {
        return self::$postRoutes;
    }
}