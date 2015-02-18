<?php

namespace TwiCli;

class TwiCliTest extends \PHPUnit_Framework_TestCase
{
    public function testUserCanPostMultipleMessagesOnHisWall()
    {
        $twiCli = new TwiCli();
        $twiCli->process('Alice -> This is test message 1');
        $twiCli->process('Alice -> This is test message 2');

        $users = $twiCli->getUsers();
        $this->assertEquals(1, count($users));

        $alice = $users['Alice'];
        $aliceWall = $alice->getMessages();

        $this->assertEquals('Alice', $alice->getName());
        $this->assertEquals(2, count($aliceWall));
    }
}
