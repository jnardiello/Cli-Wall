<?php

namespace TwiCli;

/**
 * Class Message
 * @author Jacopo Nardiello
 */
class Message
{
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function getValue()
    {
        return $this->message;
    }
}
