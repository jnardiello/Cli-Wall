<?php

namespace TwiCli\Events;

class EventStoreTest extends \PHPUnit_Framework_TestCase
{
    public function testCanStoreAGenericEvent()
    {
        $eventStore = new EventStore();
        $eventBuilder = new EventBuilder();
        $payload = [
            'test-field-1' => 'test-value',
            'test-field-2' => 'test-value',
        ];
        $event = $eventBuilder->setType('test-type')
                              ->setOrigin('test-origin')
                              ->setPayload($payload)
                              ->build();

        $eventStore->push($event);

        $this->assertEquals(1, count($eventStore->getStream()));
    }
}
