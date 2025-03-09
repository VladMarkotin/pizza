<?php
namespace App\Kernel\DB\QueryBuilder\Operators;


trait GroupBy
{
    public function groupBy(array $fields)
    {
        $this->query .=  " GROUP BY {PREGROUP} ";
        $this->compileGroupBy($fields);

        return $this;
    }

    public function compileGroupBy(array $fields)
    {
        if (count($fields) == 1) {
            $compile = $fields[0];
        } else {
            $compile = implode(',',
                array_map( function ($item) {
                    return "$item";
                }, $fields
            )
            );
        }

        $this->query = str_replace("{PREGROUP}", $compile, $this->query);

    }
}