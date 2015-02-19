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
        $bob->post('This is another test message');
        sleep(1);

        $alice->post('Ehi There!');

        $bob->follow($alice);
        $wall = $bob->wall();

        $this->assertEquals(3, count($wall));
        $this->assertEquals('This is another test message', $wall[1]->getValue());
    }
}
