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
        return array_reverse($this->messages);
    }

    public function add(Message $message)
    {
        $this->messages[] = $message;
    }

    public function addUser(User $user)
    {
        $this->users[$user->getName()] = $user;
    }

    public function read()
    {
        $publicWall = [];
        $result = [];

        foreach ($this->users as $user) {
            $publicWall = array_merge($publicWall, $user->getMessages());
        }

        foreach ($publicWall as $message) {
            $result[$message->getTimestamp()] = $message;
        }

        ksort($result);
        return array_reverse(array_values($result));
    }
}
