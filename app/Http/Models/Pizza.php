<?php
namespace App\Http\Models;



class Pizza
{
    public $id;
    public $name;
    public $price;
    public $size;

    public function __construct()
    {
        
    }

    public function setPizza(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['pizza'];
        $this->price =  $data['price'];
        $this->size = $data['size'];
    }
}