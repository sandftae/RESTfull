<?php

namespace DataProviders\Database\AbstractDataProvider;

use DataProviders\Database\Connector\Connector;
use DataProviders\Config;

/**
 * Class DataProvider
 * @package DataProviders\Database\AbstractDataProvider
 */
class DataProvider extends Connector
{
    /**
     * @param   string  $column
     * @param   int     $id
     * @return  int
     */
    public function status(string $column, int $id):int
    {
        $sql    = 'SELECT ' . $column . ' FROM ' . Config::TABLE_NAME . ' WHERE id="' . $id . '"';

        $query  = $this->connection->query($sql);

        return $query->fetchAll(\PDO::FETCH_ASSOC)[0][$column];
    }

    /**
     * @param   int     $id
     * @return  array
     */
    public function giveEntity(int $id):array
    {
        $sql    = 'SELECT * FROM ' . Config::TABLE_NAME . ' WHERE id="' . $id . '"';

        $query  = $this->connection->query($sql);

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}
