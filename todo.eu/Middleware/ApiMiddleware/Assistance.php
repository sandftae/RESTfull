<?php

namespace Middleware\ApiMiddleware;


/**
 * Class        Assistance
 * @package     Middleware\ApiMiddleware
 */
class Assistance
{
    /**
     * @param   string      $string
     * @return  null|mixed
     */
    static public function checkIdInString(string $string)
    {
        $data   = explode('/', $string);
        $val    =  $data[count($data) - 1];

        return ($val !== 'note') ? $val : null;
    }

    /**
     * @param   $data
     * @return  string
     */
    static public function encode($data):string
    {
        return (string) json_encode($data);
    }

    /**
     * @param   string  $string
     * @return  mixed
     */
    static public function decode(string $string)
    {
        return json_decode($string);
    }

    /**
     * @param array $data
     * @return string
     */
    static public function errors(array $data):string
    {
        return self::encode($data);
    }
}