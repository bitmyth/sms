<?php

namespace Myth\Contracts;

/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/1
 * Time: 10:03 PM
 */
interface SmsBroker
{
    /**
     * @param string $phone
     * @param Message $message
     * @return array
     */
    public function send($phone, $message);
}
