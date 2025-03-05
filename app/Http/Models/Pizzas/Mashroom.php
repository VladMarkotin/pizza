<?php
namespace App\Http\Models\Pizzas;


use App\Http\Models\AbstractPizza;

class Mashroom extends AbstractPizza
{
    public function __construct(array $data)
    {
        parent::__construct($data['pizza'], $data['price'], $data['size'], $data['sauce']);
    }
}