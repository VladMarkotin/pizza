<?php
namespace App\Kernel\DB;


use App\Init\Init;
use App\Kernel\DI;
use \PDO;

class DBClass
{
    private static $instance = null;
    private static $dbh = null;

    public static function getInstance()
    {
        if (self::$instance) {
            return self::$instance;
        }
        
        return (new self);
    }

    public static function getDbh()
    {
        return self::$dbh;
    }

    private function __construct()
    {
        try {
            self::$dbh = new \PDO("$_ENV[DB_TYPE]:host=$_ENV[DB_HOST];dbname=$_ENV[DB_NAME]", $_ENV['DB_USER'], $_ENV['DB_PASS']);
        }
        catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
        
    }
}