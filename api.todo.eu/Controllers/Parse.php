<?php

namespace Controllers;

use Helpers\Helper;
use Models\Processor;
use Interfaces\ParseInterfaces;

/**
 * Class        Parse
 * @package     Controllers
 */
class Parse implements ParseInterfaces
{
    private $processor;

    /**
     * Parse constructor.
     */
    public function __construct()
    {
        $this->processor = new Processor();
    }

    /**
     * @param               $request
     * @param       null    $data
     * @return      void
     */
    public function run($request, $data = null):void
    {
        $method = strtolower($request['REQUEST_METHOD']);
        $data   = Helper::decode($data);

         Helper::encode(
             $this->processor->generator($method, ['data' => $data])
         );
    }
}
