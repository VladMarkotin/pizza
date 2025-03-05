<?php
namespace App\Facades\DB;


use \App\Kernel\DB\DBClass;
use \App\Facades\Collections\DBCollection;

class DB
{
    private static $dbh = null;
    
    private static array $dataCollection;

    public static function query(string $query, DBCollection $collector = null)
    {
        self::setDbh();
        $result = (self::$dbh->query($query));
        
        if ($collector) {
            return $collector->collect($result)->get();
        }
        
        return $result;
    }

    public static function exec(string $query)
    {
        self::$dbh->exec($query);
    }

    private static function setDbh()
    {
        self::$dbh = DBClass::getDbh();
    }
}