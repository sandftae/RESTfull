<?php

namespace Models\ApiModels;

use Interfaces\ApiInterfaces\ApiModelsInterfaces;
use Models\ApiModels\Http\Http;


/**
 * Class        ApiModels
 * @package     Models\ApiModels
 */
class ApiModels implements ApiModelsInterfaces
{
    /**
     * @var Http
     */
    private $curl;

    /**
     * ApiModels constructor.
     */
    public function __construct()
    {
        $this->curl = new Http();
    }

    /**
     * @param   mixed   ...$params
     * @return  mixed
     */
    public function get(...$params)
    {
        return $this->curl->init()->headers()->get()->go();
    }

    /**
     * @param mixed ...$params
     * @return mixed
     */
    public function post(...$params)
    {
        extract(array_shift($params));

        return $this->curl->init($data)->headers()->post()->go();
    }

    /**
     * @param   mixed   ...$params
     * @return  mixed
     */
    public function put(...$params)
    {
        extract(array_shift($params));
        return $this->curl->init($id)->headers()->put()->go();
    }

    /**
     * @param   mixed   ...$params
     * @return  mixed
     */
    public function delete(...$params)
    {
        extract(array_shift($params));
        return $this->curl->init($id)->headers()->delete()->go();
    }


}