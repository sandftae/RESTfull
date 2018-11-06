<?php

namespace Helpers;

/**
 * Class Helper
 * @package Helpers
 */
class Helper
{
    /**
     * @param   $data
     * @return  string
     */
    public static function encode($data):string
    {
        return (string) json_encode($data);
    }

    /**
     * @param   string  $string
     * @return  mixed
     */
    public static function decode(string $string)
    {
        return json_decode($string);
    }

    /**
     * @param   array   $data
     * @param   array   $success
     * @return  string
     */
    public static function success(array $data, array $success):string
    {
        return self::encode(array_merge($data, $success));
    }
}
