<?php

namespace Myth;

use Illuminate\Support\Manager;
use InvalidArgumentException;
use Myth\Brokers\AliyunBroker;
use Myth\Brokers\YunpianBroker;

/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/1
 * Time: 10:00 PM
 */
class SmsBrokerManager extends Manager implements Contracts\SmsBrokerFactory
{
    /**
     * @param $name
     * @return mixed
     */
    public function createDriver($name)
    {
        $config = $this->getConfig($name);

        if (is_null($config)) {
            throw new InvalidArgumentException("Sms broker [{$name}] is not defined.");
        }

        if (isset($this->customCreators[$config['driver']])) {
            return $this->callCustomCreator($name);
        }

        $driverMethod = 'create' . ucfirst($config['driver']);

        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($config);
        }

        throw new InvalidArgumentException("Sms driver [{$config['driver']}] for [{$name}] is not defined.");
    }

    /**
     * @param $config
     * @return AliyunBroker
     */
    public function createAliyunBroker($config)
    {
        $broker = new AliyunBroker($config);
        return $broker;
    }

    public function createYunpianBroker($config)
    {
        $broker = new YunpianBroker($config);
        return $broker;
    }

    /**
     * @return mixed
     */
    public function getDefaultDriver()
    {
        return $this->app['config']['sms.defaults'];
    }

    /**
     * @param $name
     * @return mixed
     */
    protected function getConfig($name)
    {
        return $this->app['config']["sms.brokers.{$name}"];
    }

}
