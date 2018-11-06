<?php

namespace Models\ApiModels\Config;

/**
 * Class        ApiConfig
 * @package     Models\ApiModels\Config
 */
class ApiConfig
{
    /**
     * @return array
     */
    static public function uriToSend()
    {
        return ['url' => 'http://api.todo.eu/index.php'];
    }

    /**
     * @return array
     */
    static public function uriToKey()
    {
        return ['url' => 'http://api.todo.eu/keyGen'];
    }

    /**
     * @return array
     */
    static public function dataToAuth()
    {
        return
        [
            'username'  => 'my_user',
            'password'  => 'qwerty'
        ];
    }
}