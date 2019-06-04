<?php

namespace Myth;

use Closure;
use InvalidArgumentException;
use Myth\Brokers\AliyunBroker;
use Myth\Brokers\YunpianBroker;
use Myth\Contracts\SmsBroker;

/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/1
 * Time: 10:00 PM
 */
class SmsBrokerManager implements \Myth\Contracts\SmsBrokerFactory
{
    /**
     * @var
     */
    protected $app;
    /**
     * @var array
     */
    protected $brokers = [];

    protected $customCreators = [];

    /**
     * SmsBrokerManager constructor.
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param $name
     * @return SmsBroker
     */
    public function broker($name = null)
    {
        $name = $name ?: $this->getDefaultDriver();

        return isset($this->brokers[$name])
            ? $this->brokers[$name]
            : $this->brokers[$name] = $this->resolve($name);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function resolve($name)
    {
        $config = $this->getConfig($name);
        if (is_null($config)) {
            throw new InvalidArgumentException("Sms broker [{$name}] is not defined.");
        }

        if (isset($this->customCreators[$config['driver']])) {
            return $this->callCustomCreator($name, $config);
        }

        $driverMethod = 'create' . ucfirst($config['driver']);

        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($config);
        }

        throw new InvalidArgumentException("Sms driver [{$config['driver']}] for [{$name}] is not defined.");
    }

    protected function callCustomCreator($name, array $config)
    {
        return $this->customCreators[$config['driver']]($this->app, $name, $config);
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

    public function extend($driver, Closure $callback)
    {
        $this->customCreators[$driver] = $callback;

        return $this;
    }

    public function __call($method, $parameters)
    {
        return $this->broker()->{$method}(...$parameters);
    }
}
