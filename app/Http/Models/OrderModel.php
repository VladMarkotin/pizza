<?php
namespace App\Http\Models;


use App\Http\Services\CurrencyRateService;
use App\Http\Models\AbstractPizza;

class OrderModel
{
    private $pizza; // Массив объектов пицц
    private $rate;
    public $sauce;

    public function __construct(CurrencyRateService $rate)
    {
        $this->rate = $rate->getCurrencyById(CurrencyRateService::USD)['USD'];
    }


    public function addPizza(AbstractPizza $pizza): void
    {
        $this->pizza = $pizza;
    }

    
    public function showOrder()
    {
        $this->calculateTotal();

        return json_encode($this->pizza);
    }
    
    private function calculateTotal()
    {
        $this->pizza->price = ($this->pizza->price * $this->rate);
    }
}