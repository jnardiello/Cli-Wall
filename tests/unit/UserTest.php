<?php

namespace TwiCli;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testUserCanAddPostMessage()
    {
        $user = new User('Alice');
        $user->post('This is a test message');

        $wall = $user->messages();
        $this->assertEquals(1, count($wall));
        $this->assertEquals('This is a test message', $wall[0]);
    }
}
