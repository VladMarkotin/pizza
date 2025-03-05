<?php
namespace App\Kernel\Router;


use App\Facades\Auth\Auth;
use App\Facades\Response\Response;

class RouteConfiguration
{
    public string $route = '';

    public string $controller;

    public string $action;

    public string $name;

    public function __construct(string $route, string $controller, string $action)
    {
        $this->route = $route;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    public function middleware(string $type = 'guest')
    {
        switch ($type) {
            case 'auth': 
                if (!Auth::isAuth()) {
                    //Response::away('login');
                }
                break;
            case 'guest':
                break;
        }

         return $this;
    }
}