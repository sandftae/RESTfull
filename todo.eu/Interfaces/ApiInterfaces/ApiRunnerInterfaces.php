<?php

namespace Interfaces\ApiInterfaces;

/**
 * Interface    ApiRunnerInterfaces
 * @package     Interfaces\ApiInterfaces
 */
interface ApiRunnerInterfaces
{
    /**
     * @param                       $request
     * @param   null                $data
     * @return  ApiRunnerInterfaces
     */
    public function parse($request, $data = null):self;

    /**
     * @return  mixed
     */
    public function retrieve();
}