<?php

namespace Middleware\Logger;

/**
 * Class        Logger
 * @package     Middleware\Logger
 */
class Logger
{
    /**
     * path to logs file
     */
    const FILE_PATH = '../../logs/logs.txt';

    /**
     * @param   $message
     */
    public function write($message)
    {
        file_put_contents(self::FILE_PATH, $message . "\n", FILE_APPEND);
    }
}