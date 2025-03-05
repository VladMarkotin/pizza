<?php
namespace App\Http\Controllers;


use App\Kernel\DI\Container;

class Controller
{
    public $container;
    public $view;

    public function __construct()
    {
        $this->container = new Container();
    }
}