<?php

namespace TwiCli;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->user = new User('Alice');
        $this->user->post('This is a test message');
    }

    public function testUserCanAddPostMessage()
    {
        $messages = $this->user->messages();

        $this->assertEquals(1, count($messages));
        $this->assertEquals('This is a test message', $messages[0]);
    }
}
