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
        $postEventType = "message-posted";
        $followEventType = "user-followed";
        $postEvent = $this->eventBuilder->setType($postEventType)
                                        ->setOrigin('test-origin')
                                        ->setPayload([])
                                        ->build();
        $this->streamRepository->append($postEvent);

        $followEvent = $this->eventBuilder->setType($followEventType)
                                          ->setOrigin('test-origin')
                                          ->setPayload([])
                                          ->build();
        $this->streamRepository->append($followEvent);

        $stream = $this->streamRepository->getByType($postEventType);

        $this->assertEquals(1, count($stream));
        $this->assertEquals($postEvent, $stream[0]);
    }

    public function testShouldGetStreamByTypeAndAuthor()
    {
        $alice = "Alice";
        $bob = "Bob";
        $postType = "message-posted";
        $followType = "user-followed";

        $postEventAlice = $this->eventBuilder->setType($postType)
                                             ->setOrigin($alice)
                                             ->setPayload([])
                                             ->build();
        $this->streamRepository->append($postEventAlice);

        $followEventAlice = $this->eventBuilder->setType($followType)
                                               ->setOrigin($alice)
                                               ->setPayload([])
                                               ->build();
        $this->streamRepository->append($followEventAlice);

        $followEventBob = $this->eventBuilder->setType($followType)
                                             ->setOrigin($bob)
                                             ->setPayload([])
                                             ->build();
        $this->streamRepository->append($followEventBob);

        $stream = $this->streamRepository->getByTypeAndOrigin($postType, $alice);

        $this->assertEquals(1, count($stream));
        $this->assertEquals($postEventAlice, $stream[0]);
    }
}
