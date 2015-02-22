<?php

namespace TwiCli\Events;

class EventBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldBuildEvent()
    {
        $type = "an-event-type";
        $origin = "an-event-origin";
        $payload = [
            "field-test-1" => "field-value",
            "field-test-2" => "field-value",
        ];

        $eventBuilder = new EventBuilder();
        $event = $eventBuilder->setType($type)
                              ->setOrigin($origin)
                              ->setPayload($payload)
                              ->build();
        $expectedEvent = new Event($type, $origin, $payload);

        $this->assertEquals($expectedEvent, $event);
    }
}
