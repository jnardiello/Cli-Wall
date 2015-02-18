<?php

namespace TwiCli;

class TwiCliTest extends \PHPUnit_Framework_TestCase
{
    public function testUserCanPostMessageToHisWall()
    {
        $input = "Alice -> This is a test message";
        $twiCli = new TwiCli();
        $twiCli->process($input);

        $users = $twiCli->users();
        $this->assertEquals(1, count($users));

        $alice = $users[0];
        $aliceWall = $alice->wall();
        $this->assertEquals('Alice', $alice->getName());
        $this->assertEquals('This is a test message', $aliceWall->getMessage());
    }
}
