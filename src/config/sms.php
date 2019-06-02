<?php
/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/1
 * Time: 10:55 PM
 */
return [
    'defaults' => 'aliyun',
    'brokers' => [
        'aliyun' => [
            'driver' => 'AliyunBroker',
            'accessKeyId' => env('ALIYUN_ACCESS_KEY_ID'),
            'accessSecret' => env('ALIYUN_ACCESS_SECRET', '8cQ840vHdjdGK5UfhYfTEhLwLfKiad'),
            'regionId' => env('ALIYUN_SMS_REGION_ID'),
            'signName' => env('ALIYUN_SMS_SIGN_NAME'),
            'templateCode' => env('ALIYUN_SMS_TEMPLATE_CODE'),
        ]
    ]
];
