<?php
namespace App\Http\Models;


class AbstractPizza
{
    public string $name;   // Название пиццы
    public float $price;   // Цена пиццы
    public float $size; 
    public string $sauce;

    public function __construct(string $name, float $price, float $size, string $sauce)
    {
        $this->name = $name;
        $this->price = $price;
        $this->size = $size;
        $this->sauce = $sauce;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getIngredients(): float
    {
        return $this->ingredients;
    }

    public function __toString(): string
    {
        return $this->name . " - $" . $this->price;
    }
}