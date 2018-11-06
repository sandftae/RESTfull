<?php

namespace Interfaces;

/**
 * Interface ParseInterfaces
 * @package Interfaces
 */
interface ParseInterfaces
{
    /**
     * @param           $request
     * @param   null    $data
     */
    public function run($request, $data = null):void;
}
