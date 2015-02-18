<?php

namespace TwiCli;

/**
 * Class User
 * @author Jacopo Nardiello
 */
class User
{
    private $messages = [];

    public function post($message)
    {
        $this->messages[] = $message;
    }

    public function messages()
    {
        return $this->messages;
    }
}
