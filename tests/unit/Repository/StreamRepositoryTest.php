<?php

namespace TwiCli\Repository;

use TwiCli\Events\EventStore;
use TwiCli\Events\EventBuilder;

class StreamRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnAStreamOfEvents()
    {
        $eventStore = new EventStore();
        $streamRepository = new StreamRepository($eventStore);

        $stream = $streamRepository->getAll();

        $this->assertTrue(is_array($stream));
    }

    public function testShouldAppenEventToStream()
    {
        $eventBuilder = new EventBuilder();
        $eventStore = new EventStore();
        $streamRepository = new StreamRepository($eventStore);
        $event = $eventBuilder->setType('test-type')
                              ->setOrigin('test-origin')
                              ->setPayload([])
                              ->build();

        $streamRepository->append($event);

        $this->assertEquals(1, count($streamRepository->getAll()));
    }
}
