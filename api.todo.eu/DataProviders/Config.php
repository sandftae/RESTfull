<?php

namespace DataProviders;

/**
 * Class        Config
 * @package     DataProviders
 */
class Config
{
    const TABLE_NAME    = 'todo';

    const DONE          = 'done_status';
    const DELETE        = 'delete_status';
    const MESSAGE       = 'message';

    /**
     * @param   int     $id
     * @param   string  $string
     * @param   bool    $error
     * @return  array
     */
    public static function message(int $id, string $string, $error = false):array
    {
        return
        [
            'id'        => $id,
            'status'    => $string,
            'error'     => $error
        ];
    }

    /**
     * @return array
     */
    public static function connector():array
    {
        return
        [
            'host'      => '127.0.0.1',
            'db'        => 'rest',
            'user'      => 'root',
            'password'  => ''
        ];
    }

    /**
     * @param string $method
     * @return string
     */
    public static function path(string $method):string
    {
        return (string) "Api/Todo/note/${method}/${method}.php";
    }
}
