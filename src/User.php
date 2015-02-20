<?php

namespace TwiCli;

/**
 * Class User
 * @author Jacopo Nardiello
 */
class User
{
    private $name;
    private $wall;
    private $following = [];

    public function __construct($name)
    {
        $this->name = $name;
        $this->wall = new Wall($this);
    }

    public function post($message)
    {
        $this->wall->add(new Message($message, $this));
    }

    public function follow(User $user)
    {
        $this->following[] = $user;
        $this->wall->addUser($user);
    }

    public function wall()
    {
        return $this->wall->read();
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
