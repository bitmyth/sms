<?php

use Illuminate\Foundation\Application;
use Myth\Messages\VerificationCode;
use Myth\SmsBrokerManager;

/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/1
 * Time: 10:57 PM
 */
require __DIR__ . '/../../vendor/autoload.php';


$app = new Application(
    realpath(__DIR__ . '/../')
);

$app->bootstrapWith([
    \Illuminate\Foundation\Bootstrap\LoadConfiguration::class,
    \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
]);

$smsManager = new SmsBrokerManager($app);
$sms = $smsManager->broker('aliyun');
$result = $sms->send('18911209450', new VerificationCode(1182));

print_r($result);
