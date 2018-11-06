<?php

namespace Helpers\Logger;

/**
 * Class Logger
 * @package Helpers\Logger
 */
class Logger
{
    const FILE_PATH = 'logs/logs.txt';

    /**
     * @param $message
     */
    public function write($message)
    {
        file_put_contents(self::FILE_PATH, $message . "\n", FILE_APPEND);
    }
}
