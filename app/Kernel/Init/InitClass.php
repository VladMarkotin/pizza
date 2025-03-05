<?php
namespace App\Kernel\Init;

use Dotenv;
use App\Kernel\DB\DBClass;
use App\Kernel\View\View;

class InitClass
{
    public function init()
    {
        $dotenv = Dotenv\Dotenv::createMutable(__DIR__.'/../../..');
        $dotenv->load();   
        DBClass::getInstance();
        View::getInstance();
    }
}