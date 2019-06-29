<?php
/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/1
 * Time: 10:33 PM
 */

namespace Myth\Brokers;

use Myth\Contracts\SmsBroker;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Yunpian\Sdk\YunpianClient;


class YunpianBroker implements SmsBroker
{

    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function send($phone, $message)
    {
        //初始化client,apikey作为所有请求的默认值
        $client = YunpianClient::create($this->config['apiKey']);

        $message = (string)$message;
        $param = [YunpianClient::MOBILE => '13470091533', YunpianClient::TEXT => $message];
        $result = $client->sms()->single_send($param);
        if ($result->isSucc()) {
            return ['success' => $result->isSucc(), 'result' => $result->data()];
        } else {
            return ['success' => false, 'result' => $result];
        }
    }
}
