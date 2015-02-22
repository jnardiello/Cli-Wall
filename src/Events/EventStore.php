<?php

namespace TwiCli\Events;

/**
 * Class EventStore
 * @author Jacopo Nardiello
 */
class EventStore
{
    private $stream = [];

    public function push(Event $event)
    {
        $this->stream[] = $event;
    }

    public function getStream()
    {
        return $this->stream;
    }
}
