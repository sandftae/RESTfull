<?php

namespace DataProviders\Database;

use DataProviders\Config;
use DataProviders\Database\AbstractDataProvider\DataProvider as AbstractDataProvider;

/**
 * Class        DataProvider
 * @package     DataProviders\Database
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @return array
     */
    public function get():array
    {
        $sql    = 'SELECT * FROM ' . Config::TABLE_NAME ;

        $query  = $this->connection->query($sql);

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param   int     $id
     * @return  array
     */
    public function put(int $id):array
    {
        $newVal = $this->status(Config::DONE, $id) == 1 ? 0 : 1;
        $sql    = null;

        if ((int) $this->giveEntity($id)[0]['delete_status'] === 1) {
            $sql = 'UPDATE '. Config::TABLE_NAME .' SET delete_status="0", done_status="1" WHERE id="' . $id . '"';
        } else {
            $sql = 'UPDATE '. Config::TABLE_NAME .' SET done_status="' . $newVal . '" WHERE id="' . $id . '"';
        }

        $conn   = $this->connection->prepare($sql);

        $conn->execute();

        return $this->giveEntity($id);
    }

    /**
     * @param   int     $id
     * @return  array
     */
    public function delete(int $id):array
    {
        $id = (int) $id;

        $newVal = $this->status(Config::DELETE, $id) === 1 ? 0 : 1;
        $sql    = 'UPDATE '. Config::TABLE_NAME .' SET delete_status="' . $newVal . '" WHERE id="' . $id . '"';

        $conn   = $this->connection->prepare($sql);

        $conn->execute();

        return $this->giveEntity($id);
    }

    /**
     * @param   $data
     * @return  array
     */
    public function post($data):array
    {
        $sql    = 'INSERT INTO ' . Config::TABLE_NAME . ' values(null, ?, ?, ?)';

        $conn   = $this->connection->prepare($sql);

        $conn->execute([$data, 1, 0]);

        return $this->giveEntity($this->connection->lastInsertId());
    }
}
