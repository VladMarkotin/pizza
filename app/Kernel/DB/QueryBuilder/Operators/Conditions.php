<?php
namespace App\Kernel\DB\QueryBuilder\Operators;


trait Conditions
{
    public function where($arg1, $o, $arg2)
    {
        $this->query .=  " WHERE $arg1 $o ".$this->handleString($arg2);

        return $this;
    }

    public function and($arg1, $o, $arg2)
    {
        $this->query .=  " AND $arg1 $o ".$this->handleString($arg2);

        return $this;
    }

    public function or($arg1, $o, $arg2)
    {
        $this->query .=  " OR $arg1 $o ".$this->handleString($arg2);

        return $this;
    }

    public function distinct()
    {
        $this->setFlag('distinct', true);

        return $this;
    }

    public function handleString($arg2)
    {
        return is_string($arg2) ? "\"$arg2\"" : $arg2;
    }
}