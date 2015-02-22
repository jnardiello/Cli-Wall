<?php

namespace TwiCli\Repository;

use TwiCli\Events\EventStore;
use TwiCli\Events\EventBuilder;

class StreamRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->eventBuilder = new EventBuilder();
        $eventStore = new EventStore();
        $this->streamRepository = new StreamRepository($eventStore);
    }

    public function testShouldReturnAStreamOfEvents()
    {
        $stream = $this->streamRepository->getAll();

        $this->assertTrue(is_array($stream));
    }

    public function testShouldAppenEventToStream()
    {
        $event = $this->eventBuilder->setType('test-type')
                                    ->setOrigin('test-origin')
                                    ->setPayload([])
                                    ->build();

        $this->streamRepository->append($event);

        $this->assertEquals(1, count($this->streamRepository->getAll()));
    }

    public function testShouldGetStreamByType()
    {
        $postEvent = $this->eventBuilder->setType('message-posted')
                                        ->setOrigin('test-origin')
                                        ->setPayload([])
                                        ->build();
        $this->streamRepository->append($postEvent);

        $followEvent = $this->eventBuilder->setType('user-followed')
                                          ->setOrigin('test-origin')
                                          ->setPayload([])
                                          ->build();
        $this->streamRepository->append($followEvent);

        $stream = $this->streamRepository->getByType($postEvent);

        $this->assertEquals(1, count($stream));
        $this->assertEquals($postEvent, $stream[0]);
    }
}