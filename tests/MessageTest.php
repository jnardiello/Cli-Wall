<?php

namespace TwiCli;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function testCanPostMessage()
    {
        $message = new Message('This is a test message');

        $this->assertEquals('This is a test message', $message->getValue());
    }
}
