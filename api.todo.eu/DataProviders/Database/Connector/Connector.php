<?php

namespace DataProviders\Database\Connector;

use DataProviders\Config;

/**
 * Class        Connector
 * @package     DataProviders\Database\Connector
 */
class Connector
{
    public $connection;

    /**
     * Connector constructor.
     */
    public function __construct()
    {
        try {
            $database = new \PDO(
                "mysql:host="
                . Config::connector()['host']
                . ";dbname=" . Config::connector()['db']
                . ";charset=utf8",
                Config::connector()['user'],
                Config::connector()['password']
            );

            $database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $this->connection = $database;
        } catch (\Exception $e) {
            return "Database connection failed. Cause: " . $e -> getMessage();
        }
    }
}
