<?php

namespace Models;

use DataProviders\Config;
use Helpers\Logger\Logger;
use DataProviders\Database\DataProvider;
use Models\AbstractModels\Processor as AbstractProcessor;

/**
 * Class        Processor
 * @package     Models
 */
class Processor extends AbstractProcessor
{
    /**
     * @var DataProvider
     */
    private $dataProvider;

    private $logger;

    /**
     * Processor constructor.
     */
    public function __construct()
    {
        $this->dataProvider = new DataProvider();
        $this->logger       = new Logger();
    }

    /**
     * @param string $method
     * @param mixed ...$data
     * @return array
     */
    public function generator(string $method, ...$data):array
    {
        extract(array_shift($data));

        try {
            if (file_exists(Config::path($method))) {
                return $this->context(
                    Config::path($method),
                    $this->dataProvider->{$method}($data)
                );
            } else {
                throw new \Exception('Record is not held. No such presentation.');
            }
        } catch (\Exception $exception) {
            $this->logger->write('Error! ' . $exception->getMessage());

            return $this->context(
                Config::path('errors')
            );
        }
    }
}
