<?php
namespace App\Facades\Collections;


class DBCollection
{
    private $collection = null;

    public function collect($data, $param = \PDO::FETCH_OBJ)
    {
        $this->collection = $data->fetchAll($param);

        return $this;
    }

    public function get()
    {
        return $this->collection;
    }
}