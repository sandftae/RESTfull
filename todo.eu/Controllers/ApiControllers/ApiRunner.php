<?php

namespace Controllers\ApiControllers;

use Interfaces\ApiInterfaces\ApiRunnerInterfaces;
use Middleware\ApiMiddleware\Assistance;
use Models\ApiModels\ApiModels;


/**
 * Class        ApiRunner
 * @package     Controllers\ApiControllers
 */
class ApiRunner implements ApiRunnerInterfaces
{
    /**
     * @var ApiModels
     */
    private $model;

    /**
     * @var array
     */
    private $data;

    /**
     * ApiRunner constructor.
     */
    public function __construct()
    {
        $this->model      = new ApiModels();
    }

    /**
     * @param                               $request
     * @param       null                    $data
     * @return      ApiRunnerInterfaces
     */
    public function parse($request, $data = null):ApiRunnerInterfaces
    {
       $method      = strtolower($request['REQUEST_METHOD']);
       $url         = $request['REQUEST_URI'];

       $id          = (int) Assistance::checkIdInString($url);
       $data        = Assistance::decode($data);

       $this->data = $this->model->{$method}(['data' => $data, 'id' => $id]);

       return $this;
    }

    /**
     * @return  array|mixed
     */
    public function retrieve()
    {
        return $this->data;
    }
}