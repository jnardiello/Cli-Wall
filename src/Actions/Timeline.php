<?php

namespace TwiCli\Actions;

/**
 * Class Post
 * @author Jacopo Nardiello
 */
class Timeline implements Executable
{
    public function execute(array $params)
    {
        $user = $params['user'];
        foreach ($user->getMessages() as $message) {
            // test message (1 seconds ago)
            echo "{$message->getValue()} ({$message->getAge()})\n";
        }
    }
}
