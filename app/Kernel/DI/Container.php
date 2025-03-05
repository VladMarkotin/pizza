<?php
namespace App\Kernel\DI;


use App\Kernel\Init\InitClass;
use App\Kernel\DB\QueryBuilder\Builder;
use App\Facades\Collections\DBCollection;
use App\Kernel\DB\DBClass;
use App\Facades\Request\Request;
use App\Kernel\View\View;
use App\Http\Services\CurrencyRateService;

class Container
{
    private $objects = [];

    public function __construct()
    {
        $this->objects = [
            
            InitClass::class => function (){ return new InitClass();},
            DBCollection::class => function () {return new DBCollection();},
            Builder::class => function () {
                return new Builder(
                    $this->get(DBCollection::class)
                );
            },
            DBClass::class => function () {return DBClass::getInstance();},
            View::class => function () {return View::getInstance();},
            Request::class => function () {return new Request();},
            CurrencyRateService::class => function () {return new CurrencyRateService();},
        ];
    }

    public function has(string $id): bool
    {
        return isset($this->objects[$id]);
    }

    public function get(string $id): mixed
    {
        return $this->objects[$id]();
    }
}