<?php

namespace Models\AbstractModels;

use Interfaces\ProcessorInterface;

/**
 * Class        Processor
 * @package     Models\AbstractModels
 */
abstract class Processor implements ProcessorInterface
{
    /**
     * @param string $methodName
     * @param mixed ...$data
     * @return array
     */
    abstract public function generator(string $methodName, ...$data):array;

    /**
     * @param string $url
     * @param array $data
     * @return array
     */
    public function context(string $url, array $data = null):array
    {

        require $url;

        return $data;
    }
}
