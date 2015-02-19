<?php

namespace TwiCli\Actions;

/**
 * Class Post
 * @author Jacopo Nardiello
 */
class Wall implements Executable
{
    public function execute(array $params)
    {
        $user = $params['user'];
        $wall = $user->wall();

        foreach ($wall as $message) {
            echo "{$message->getAuthor()} - {$message->getValue()} ({$message->getAge()})\n";
        }
    }
}
