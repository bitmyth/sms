<?php

namespace Myth\Contracts;

/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/1
 * Time: 10:03 PM
 */
interface SmsBrokerFactory
{
    public function broker($name);
}
