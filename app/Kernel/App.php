<?php
namespace App\Kernel;


use App\Kernel\Init\InitClass;
use App\Kernel\Router\Router;
use App\Kernel\Router\RouteDispatcher;

class App
{
    public static function run(InitClass $init)
    {
        $init->init();//"Skeleton run!";
        $requestMethod = ucfirst( strtolower($_SERVER['REQUEST_METHOD']) ); 
        $methodName = 'getRoutes'.$requestMethod;
        
        foreach (Router::$methodName() as $routeConfig) {
            $routeDispatcher = new RouteDispatcher($routeConfig);
            $routeDispatcher->process();
        }

    }
}