<?php

namespace TwiCli;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->user = new User('Alice');
    }

    public function testUserCanPostMessage()
    {
        $this->user->post('This is a test message');
        $messages = $this->user->messages();

        $this->assertEquals(1, count($messages));
        $this->assertEquals('This is a test message', $messages[0]->getValue());
    }
}
