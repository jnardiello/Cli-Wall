<?php

namespace TwiCli;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->user = new User('Alice');
    }

    public function testUserHasAName()
    {
        $this->assertEquals('Alice', $this->user->getName());
    }

    public function testUserCanPostMessage()
    {
        $this->user->post('This is a test message');
        $messages = $this->user->getMessages();

        $this->assertEquals(1, count($messages));
        $this->assertEquals('This is a test message', $messages[0]->getValue());
    }

    public function testUserCanFollowSomeone()
    {
        $bob = new User('Bob');

        $this->user->follow($bob);
        $this->assertEquals(1, count($this->user->getFollowingList()));
    }
}
