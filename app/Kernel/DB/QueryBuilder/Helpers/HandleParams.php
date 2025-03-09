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
            return $item;
        }, $args));
    }

    public static function handleFieldsArray(array $fields)
    {
        if (count($fields) === 1) {
            return "'$fields[0]'";
        }

        return implode(',', array_map(function($item) {
            return "`" . str_replace("`", "``", $item) . "`";
        }, $fields));
    }
}