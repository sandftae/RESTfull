<?php

namespace Interfaces;

/**
 * Interface    ProcessorInterface
 * @package     Interfaces
 */
interface ProcessorInterface
{
    /**
     * @param string $methodName
     * @param mixed ...$data
     * @return array
     */
    public function generator(string $methodName, ...$data):array;

    /**
     * @param   string  $url
     * @param   array   $data
     * @return  array
     */
    public function context(string $url, array $data):array;
}
