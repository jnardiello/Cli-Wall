<?php

namespace TwiCli\Events;

/**
 * Class Event
 * @author Jacopo Nardiello
 */
class Event
{
    private $type;
    private $origin;
    private $payload;

    public function __construct($type, $origin, $payload = null)
    {
        $this->type = $type;
        $this->origin = $origin;
        $this->payload = $payload;
    }
}
