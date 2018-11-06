<?php

namespace Interfaces\ApiInterfaces;

/**
 * Interface    ApiModelsInterfaces
 * @package     Interfaces\ApiInterfaces
 */
interface ApiModelsInterfaces
{
    /**
     * @param   mixed   ...$params
     * @return  mixed
     */
    public function get(...$params);

    /**
     * @param   mixed   ...$params
     * @return  mixed
     */
    public function put(...$params);

    /**
     * @param   mixed   ...$params
     * @return  mixed
     */
    public function post(...$params);

    /**
     * @param   mixed   ...$params
     * @return  mixed
     */
    public function delete(...$params);
}