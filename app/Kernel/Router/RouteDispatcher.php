<?php
namespace App\Kernel\Router;


use App\Facades\Request\Request;
use App\Kernel\DI\Container;

class RouteDispatcher
{
    private $routeConfiguration;
    
    private string $requestUri = '';

    private array $paramMap = [];

    private array $requestParamMap = [];

    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }

    public function process()
    {
        $this->saveRequestUri();
        $this->setParamMap();
        $this->makeRegexRequest();
        $this->run();
       
    }

    private function run()
    {
        if (preg_match("/$this->requestUri/", $this->routeConfiguration->route)) {
            $this->render();
        }
    }

    private function render()
    {

        $className = $this->routeConfiguration->controller;
        $action = $this->routeConfiguration->action;

        $container = new Container;
        print(new $className)->$action($container->get(Request::class), ...($this->requestParamMap));
        exit;
    }

    private function saveRequestUri()
    {
        $clear = (function (string $route) {
            return preg_replace('/(^\/)|(\/$)/', '', $route);
        }); 
        if ($_SERVER['REQUEST_URI'] !== '/') {
            $this->requestUri = $clear($_SERVER['REQUEST_URI']);
            $this->routeConfiguration->route = $clear($this->routeConfiguration->route);
        }
    }

    private function setParamMap()
    {
        $routeArr = explode('/', $this->routeConfiguration->route);
        
        foreach ($routeArr as $k => $v) {
            if (preg_match('/{.*}/', $v)) {
                $this->paramMap[$k] = preg_replace('/(^{)|(}$)/', '', $v);
            }
        }
       
    }

    private function makeRegexRequest()
    {
        $requestUriArray = explode('/', $this->requestUri);

        foreach ($this->paramMap as $k => $v) {
            if (!isset($requestUriArray[$k])) {
                return;
            }

            $this->requestParamMap[$v] = $requestUriArray[$k];
            $requestUriArray[$k] = '{.*}';
        }
        $this->requestUri = implode('/', $requestUriArray);
        $prepareRegex = function (string $str) {
            return str_replace('/', '\/', $str);
        };
        $this->requestUri = $prepareRegex($this->requestUri);
    }
}