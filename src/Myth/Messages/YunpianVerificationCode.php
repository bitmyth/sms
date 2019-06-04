<?php

namespace Myth\Messages;

use Myth\Contracts\Message;

/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/1
 * Time: 11:27 PM
 */
class YunpianVerificationCode implements Message
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
     * @return string
     */
    public function __toString()
    {
        return sprintf('【云片网】您的验证码是%d', $this->code);
    }
}
