<?php
/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/2
 * Time: 10:50 AM
 */

namespace Myth\Controllers;

use Illuminate\Http\Request;
use Myth\Facades\SMS;
use Myth\Messages\VerificationCode;

class SmsController
{
    public function send(Request $request)
    {
        $result = SMS::send('18911209450', new VerificationCode(1182));

        return $result;
    }
}
