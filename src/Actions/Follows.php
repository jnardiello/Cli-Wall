<?php

namespace TwiCli\Actions;

/**
 * Class Post
 * @author Jacopo Nardiello
 */
class Follows implements Executable
{
    public function execute(array $params)
    {
        $target = $params['target'];
        $user = $params['user'];
        $followingUser = $target;

        $user->follow($followingUser);
    }
}
