<?php

namespace TwiCli;

/**
 * Class Wall
 * @author Jacopo Nardiello
 */
class Wall
{
    private $users = [];
    private $messages = [];

    public function __construct(User $user)
    {
        $this->users[$user->getName()] = $user;
    }

    public function getMyMessages()
    {
        return $this->messages;
    }

    public function add(Message $message)
    {
        $this->messages[] = $message;
    }

    public function addUser(User $user)
    {
        $this->users[$user->getName()] = $user;
    }
}
