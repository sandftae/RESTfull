<?php

namespace Models\ApiModels\Http;

use Middleware\ApiMiddleware\Assistance;
use Models\ApiModels\Config\ApiConfig;
use Interfaces\ApiInterfaces\HttpInterfaces;
use Middleware\Logger\Logger;

/**
 * Class        Http
 * @package     Models\ApiModels\Http
 */
class Http implements HttpInterfaces
{
    /**
     * @var $ch
     */
    private $ch;

    /**
     * @var $fields
     */
    private $fields;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * Http constructor.
     */
    public function __construct()
    {
        $this->logger = new Logger();
    }

    /**
     * @param null              $data
     * @return HttpInterfaces
     */
    public function init($data = null):HttpInterfaces
    {
        $this->fields   = Assistance::encode($data);
        $this->ch       = curl_init();

        curl_setopt($this->ch, CURLOPT_URL, ApiConfig::uriToSend()['url']);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

        return $this;
    }

    /**
     * @return HttpInterfaces
     */
    public function headers():HttpInterfaces
    {
        curl_setopt($this->ch, CURLOPT_HTTPHEADER ,[
            'Accept: application/json',
            'Content-Type: application/json'
        ]);
        return $this;
    }

    /**
     * @return HttpInterfaces
     */
    public function put():HttpInterfaces
    {
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        return $this;
    }

    /**
     * @return HttpInterfaces
     */
    public function get():HttpInterfaces
    {
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'GET');
        return $this;
    }

    /**
     * @return HttpInterfaces
     */
    public function post():HttpInterfaces
    {
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'POST');
        return $this;
    }

    /**
     * @return HttpInterfaces
     */
    public function delete():HttpInterfaces
    {
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        return $this;
    }

    /**
     * @return mixed|string
     */
    public function go()
    {
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->fields);
        $result = curl_exec($this->ch);
        curl_close($this->ch);

        try {
            if(!$result){
                throw new \Exception('There is no connection to the server.');
            } else {
                return $result;
            }
        } catch (\Exception $exception) {
            $this->logger->write($exception->getMessage());

            return Assistance::errors(
                [
                    'status'            => FALSE,
                    'error'             => TRUE,
                    'message'           => 'Something went wrong'
                ]
            );
        }
    }
}