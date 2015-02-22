<?php

namespace TwiCli\Events;

/**
 * Class EventBuilder
 * @author Jacopo Nardiello
 */
class EventBuilder
{
    private $type;
    private $origin;
    private $payload;

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;
        return $this;
    }

    public function setPayload($payload)
    {
        $this->payload = $payload;
        return $this;
    }

    public function build()
    {
        return new Event(
            $this->type,
            $this->origin,
            $this->payload
        );
    }
}
