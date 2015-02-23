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

    public function getByType($eventType, $stream = null)
    {
        if (!isset($stream)) {
            $stream = $this->eventStore->getStream();
        }
        return $this->getByParam($eventType, 'Type', $stream);
    }

    public function getByOrigin($eventOrigin, $stream = null)
    {
        if (!isset($stream)) {
            $stream = $this->eventStore->getStream();
        }
        return $this->getByParam($eventOrigin, 'Origin', $stream);
    }

    public function getByTypeAndOrigin($type, $origin)
    {
        $userEvents = [];

        $userEvents = $this->getByOrigin($origin);
        $result = $this->getByType($type, $userEvents);

        return $result;
    }

    private function getByParam($parameter, $eventField, $stream)
    {
        $result = [];
        $method = "get" . $eventField;

        foreach ($stream as $event) {
            if ($parameter == $event->$method()) {
                $result[] = $event;
            }
        }

        return $result;
    }
}
