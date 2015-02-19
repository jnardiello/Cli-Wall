<?php

namespace TwiCli;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function testCanPostMessage()
    {
        $message = new Message('This is a test message');

        $this->assertEquals('This is a test message', $message->getValue());
    }

    public function testCanRetrieveAgeOfAMessage()
    {
        $message = new Message('This is a test message');

        $this->assertEquals('(1 second ago)', $message->getAge());
    }
}
