<?php

namespace TwiCli;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function testCanPostMessage()
    {
        $author = $this->getMockBuilder('\TwiCli\User')
                       ->disableOriginalConstructor()
                       ->getMock();
        $message = new Message('This is a test message', $author);

        $this->assertEquals('This is a test message', $message->getValue());
    }

    public function testCanRetrieveAgeOfAMessage()
    {
        $author = $this->getMockBuilder('\TwiCli\User')
                       ->disableOriginalConstructor()
                       ->getMock();
        $message = new Message('This is a test message', $author);

        $this->assertEquals('1 seconds ago', $message->getAge());
    }
}
