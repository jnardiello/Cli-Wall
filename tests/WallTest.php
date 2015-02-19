<?php

namespace TwiCli;

class WallTest extends \PHPUnit_Framework_TestCase
{
    public function testCanReadUserWall()
    {
        $alice = new User('Alice');
        $alice->post('This is a test message');
        sleep(1);

        $bob = new User('Bob');
        $alice->follow($bob);
        $bob->post('This is another test message');
        sleep(1);

        $alice->post('Ehi There!');

        $wall = $alice->wall();

        $this->assertEquals(3, count($wall));
        $this->assertEquals('This is another test message', $wall[1]->getValue());
        $this->assertEquals('This is a test message', $wall[2]->getValue());
    }
}
