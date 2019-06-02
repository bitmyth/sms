<?php

namespace Myth\Messages;

use Myth\Contracts\Message;

/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/1
 * Time: 11:27 PM
 */
class VerificationCode implements Message
{
    /**
     * @var
     */
    protected $code;

    /**
     * VerificationCode constructor.
     * @param integer $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * @return false|string
     */
    public function __toString()
    {
        return json_encode([
            'code' => $this->code
        ]);
    }
}
