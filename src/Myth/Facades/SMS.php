<?php

namespace Myth\Facades;

use Myth\Contracts\SmsBroker;

/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/2
 * Time: 10:41 AM
 * @method static send($string, $param)
 */
class SMS extends \Illuminate\Support\Facades\Facade
{

    protected static function getFacadeAccessor()
    {
        return SmsBroker::class;
    }

}
