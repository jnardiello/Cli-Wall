<?php

namespace TwiCli;

/**
 * Class Wall
 * @author Jacopo Nardiello
 */
class Wall
{
    private $messages = [];

    public function getMyMessages()
    {
        return $this->messages;
    }

    public function add(Message $message)
    {
        $this->messages[] = $message;
    }
}
