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
        $this->wall = new Wall($this);
    }

    public function post($message)
    {
        $this->wall->add(new Message($message));
    }

    public function getMessages()
    {
        return $this->wall->getMyMessages();
    }

    public function getName()
    {
        return $this->name;
    }
}
