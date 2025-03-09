<?php
namespace App\Kernel\DB\QueryBuilder;


use App\Kernel\DB\QueryBuilder\Helpers\HandleParams as HP;
use App\Facades\DB\DB;
use App\Facades\Collections\DBCollection;

class Builder
{
    use Operators\Conditions;
    use Operators\GroupBy;
    use Operators\Having;
    use Operators\Join;
    
    private $query;
    private $compileSelect = "";
    private $collector;
    private $flags = [
        'distinct' => false,
    ];

    protected function setFlag($flag, $val)
    {
        $this->flags[$flag] = $val;
    }

    public function __construct(DBCollection $collector)
    {
        $this->collector = $collector;
    }

    public function select(array $args = ['*'])
    {
        $this->query = "{PRESELECT}";

        $this->query .= HP::handleSelectParams($args);

        return $this;
    }

    public function from(string $table)
    {
        $this->compileSelect();
        $this->query .= " FROM $table ";

        return $this;
    }

    public function as(string $name)
    {
        return $this->query .= " AS $name ";
    }

    public function sql()
    {
        return $this->query;
    }

    public function get()
    {
        return DB::query($this->query, $this->collector);
    }

    private function compileSelect()
    {
        $compile = "SELECT ";
        
        foreach ($this->flags as $k => $v) {
            if ($v) {
                $compile .= " $k ";
            }
        }
        
        $this->query = str_replace("{PRESELECT}", $compile, $this->query);

    }
}