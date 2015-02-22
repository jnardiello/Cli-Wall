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
        return $this->getByParam($eventType, 'Type');
    }

    public function getByOrigin($eventOrigin)
    {
        return $this->getByParam($eventOrigin, 'Origin');
    }

    private function getByParam($parameter, $eventField)
    {
        $result = [];
        $stream = $this->eventStore->getStream();
        $method = "get" . $eventField;

        foreach ($stream as $event) {
            if ($parameter == $event->$method()) {
                $result[] = $event;
            }
        }

        return $result;
    }
}
