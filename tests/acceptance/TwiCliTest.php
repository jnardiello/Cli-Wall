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
        $commands = [
            'Alice -> This is test message 1',
            'Alice -> This is test message 2',
        ];
        $this->executeCommands($commands);

        $this->assertUsersEquals(1);
        $this->assertMessagesPerUserEquals(2, 'Alice');
    }

    public function testMultipleUserCanPostOnRespectiveWall()
    {
        $commands = [
            'Alice -> This is test message',
            'Bob -> This is test message',
        ];
        $this->executeCommands($commands);

        $this->assertUsersEquals(2);
        $this->assertMessagesPerUserEquals(1, 'Alice');
        $this->assertMessagesPerUserEquals(1, 'Bob');
    }

    public function testCanReadAUserTimeline()
    {
        $commands = [
            'Alice -> Hello World',
            'Alice -> Yesterday the weather was really nice',
            'Bob -> Yesterday evening it was amazing!',
        ];
        $this->executeCommands($commands);

        $this->twiCli->process('Alice');
        $this->expectOutputString(
            "Yesterday the weather was really nice (1 seconds ago)\n" .
            "Hello World (1 seconds ago)\n"
        );
    }

    public function testUserCanFollowAnotherUser()
    {
        $commands = [
            'Alice -> Hello World',
            'Bob -> Hello World Again',
            'Alice follows Bob',
        ];
        $this->executeCommands($commands);

        $alice = $this->twiCli->getUsers()['Alice'];

        $this->assertEquals(1, count($alice->getFollowingList()));
    }

    public function testCanReadUserWall()
    {
        $this->executeCommands('Alice -> Hello World');
        sleep(1); // we need this as timestamps are used as keys in the wall
        $commands = [
            'Bob -> Hello World Again!',
            'Alice follows Bob',
            'Alice wall',
        ];
        $this->executeCommands($commands);

        $expectedOutputWall = 
                "Bob - Hello World Again! (1 seconds ago)\n" .
                "Alice - Hello World (1 seconds ago)\n";

        $this->expectOutputString($expectedOutputWall);
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

    private function executeCommands($inputs) 
    {
        if (!is_array($inputs)) {
            $this->twiCli->process($inputs);
            return;
        }

        foreach ($inputs as $input) {
            $this->twiCli->process($input);
        }
    }
}
