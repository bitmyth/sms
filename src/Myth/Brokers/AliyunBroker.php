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


class AliyunBroker implements SmsBroker
{

    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function send($phone, $message)
    {
        AlibabaCloud::accessKeyClient($this->config['accessKeyId'], $this->config['accessSecret'])
            ->regionId($this->config['regionId'])// replace regionId as you need
            ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->options([
                    'query' => [
                        'TemplateCode' => $this->config['templateCode'],
                        'SignName' => $this->config['signName'],
                        'PhoneNumbers' => $phone,
                        'TemplateParam' => $message,

                    ],
                ])
                ->request();

            // On success
            // Array
            // (
            //    [Message] => OK
            //    [RequestId] => 630F26C0-20A2-48E8-84C5-C5A86D70D670
            //    [BizId] => 262707259641659428^0
            //    [Code] => OK
            // )
            return ['success' => $result->get('Message') == 'OK', 'result' => $result->toArray()];

        } catch (ClientException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
            throw $e;
        } catch (ServerException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
            throw $e;
        }
    }
}
