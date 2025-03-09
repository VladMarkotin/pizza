<?php
namespace App\Kernel\DB\QueryBuilder\Operators;


use App\Kernel\DB\QueryBuilder\Helpers\HandleParams as HP;

trait Join
{
    public function join(string $table)
    {
        $this->query .= " JOIN $table ";

        return $this;
    }

    public function on(array $fields)
    {
        $this->query .= "ON $fields[0] $fields[1] $fields[2]";

        return $this;
    }
}