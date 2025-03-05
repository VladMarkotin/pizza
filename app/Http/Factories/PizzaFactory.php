<?php
namespace App\Http\Factories;


use App\Http\Models\Pizzas\Pepperoni;
use App\Http\Models\Pizzas\Local;
use App\Http\Models\Pizzas\Hawaian;
use App\Http\Models\Pizzas\Mashroom;
use App\Http\Models\AbstractPizza;

class PizzaFactory
{
    public static function createPizza(string $type, array $data): AbstractPizza
    {
        // dd($type == 'Pepperoni');
        switch (strtolower($type)) {
            case 'local':
                return new Local($data);
            case 'pepperoni':
                return new Pepperoni($data);
            case 'hawaiian':
                return new Hawaiian($data);
            case 'mashroom':
                return new Mashroom($data);
            default:
                throw new \InvalidArgumentException("Unknown pizza type: $type");
        }
    }
}
