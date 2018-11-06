<?php

namespace Interfaces\ApiInterfaces;

/**
 * Interface    HttpInterfaces
 * @package     Interfaces\ApiInterfaces
 */
interface HttpInterfaces
{
    /**
     * @param   null            $data
     * @return  HttpInterfaces
     */
    public function init($data = null):self;

    /**
     * @return HttpInterfaces
     */
    public function headers():self;

    /**
     * @return HttpInterfaces
     */
    public function put():self;

    /**
     * @return HttpInterfaces
     */
    public function get():self;

    /**
     * @return HttpInterfaces
     */
    public function post():self;

    /**
     * @return HttpInterfaces
     */
    public function delete():self;

    /**
     * @return mixed
     */
    public function go();
}