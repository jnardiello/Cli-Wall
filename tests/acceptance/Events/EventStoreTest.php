<?php

namespace TwiCli\Events;

class EventStoreTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->eventStore = new EventStore();
        $this->eventBuilder = new EventBuilder();
    }

    public function testCanStoreAGenericEvent()
    {
        $payload = [
            'test-field-1' => 'test-value',
            'test-field-2' => 'test-value',
        ];
        $event = $this->eventBuilder->setType('test-type')
                                    ->setOrigin('test-origin')
                                    ->setPayload($payload)
                                    ->build();

        $this->eventStore->push($event);

        $this->assertEquals(1, count($this->eventStore->getStream()));
    }
}
