<?php

namespace TwiCli;

class TwiCliTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->twiCli = new TwiCli();
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
