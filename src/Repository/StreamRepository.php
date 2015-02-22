<?php

namespace TwiCli\Repository;

use TwiCli\Events\EventStore;
use TwiCli\Events\Event;

/**
 * Class StreamRepository
 * @author Jacopo Nardiello
 */
class StreamRepository
{
    public function __construct(EventStore $eventstore)
    {
        $this->eventStore = $eventstore;
    }

    public function getAll()
    {
        return $this->eventStore->getStream();
    }

    public function append(Event $event)
    {
        $this->eventStore->push($event);
    }

    public function getByType($eventType)
    {
        $result = [];
        $stream = $this->eventStore->getStream();

        foreach ($stream as $event) {
            if ($eventType == $event->getType()) {
                $result[] = $event;
            }
        }

        return $result;
    }
}
