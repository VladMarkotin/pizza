<?php
namespace App\Kernel\DB\QueryBuilder\Helpers;


class HandleParams
{
    public static function handleSelectParams(array $args = ['*'])
    {
        if (in_array('*', $args)) {
            return '*';
        }

        return implode(',', array_map(function($item) {
            return "`" . str_replace("`", "``", $item) . "`";
        }, $args));
    }
}