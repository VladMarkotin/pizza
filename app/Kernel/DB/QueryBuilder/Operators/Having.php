<?php
namespace App\Kernel\DB\QueryBuilder\Operators;


trait Having
{
    public function having($arg1, $o, $arg2)
    {
        $this->query .=  " HAVING $arg1 $o ".$this->handleString($arg2);

        return $this;
    }
}