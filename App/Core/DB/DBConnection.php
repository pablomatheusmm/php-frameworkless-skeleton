<?php

namespace App\Core\DB;

use PDO;
use PDOException;
use Exception;

class DBConnection
{
    private static $arrConnections = [];

    private function __construct()
    {

    }

    public static function getConnection($nameDatabaseConnection = null)
    {
        try {
            $arrNameConnections = include('../App/Config/Database.php');
            $nameDatabaseConnection = $nameDatabaseConnection ?? 'default';
            $config = $arrNameConnections[$nameDatabaseConnection];

            if (is_null($config))
                throw new Exception('Nome da conexão inexiste.');

            if(is_null(self::$arrConnections[$nameDatabaseConnection])){
                $connectionString = $config['driver'] . ":host=" . $config['host'] . ";dbname=" . $config['db_name'];
                self::$arrConnections[$nameDatabaseConnection] = new PDO($connectionString, $config['user'], $config['password']);
                self::$arrConnections[$nameDatabaseConnection]->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$arrConnections[$nameDatabaseConnection]->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
        return self::$arrConnections[$nameDatabaseConnection];
    }

}