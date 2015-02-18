<?php

namespace TwiCli;

/**
 * Class User
 * @author Jacopo Nardiello
 */
class User
{
    private $messages = [];
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function post($message)
    {
        $this->messages[] = new Message($message);
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function getName()
    {
        return $this->name;
    }
}
