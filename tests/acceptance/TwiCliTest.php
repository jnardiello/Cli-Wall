<?php

namespace TwiCli;

class TwiCliTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->twiCli = new TwiCli();
    }

    public function testUserCanPostMultipleMessagesOnHisWall()
    {
        $this->twiCli->process('Alice -> This is test message 1');
        $this->twiCli->process('Alice -> This is test message 2');

        // We expect one user (Alice) and two messages for Alice
        $this->assertUsersEquals(1);
        $this->assertMessagesPerUser(2, 'Alice');
    }

    public function testMultipleUserCanPostOnRespectiveWall()
    {
        $this->twiCli->process('Alice -> This is test message');
        $this->twiCli->process('Bob -> This is test message');

        // We expect two users with one message each
        $this->assertUsersEquals(2);
        $this->assertMessagesPerUser(1, 'Alice');
        $this->assertMessagesPerUser(1, 'Bob');
    }

    private function assertUsersEquals($number)
    {
        $users = $this->twiCli->getUsers();
        $this->assertEquals($number, count($users));
    }

    private function assertMessagesPerUserEquals($numMessages, $user)
    {
        $users = $this->twiCli->getUsers();
        $user = $users[$user];
        $userMessages = $user->getMessages();
        $this->assertEquals($numMessages, count($userMessages));
    }
}
