<?php

namespace TwiCli\Actions;

/**
 * Class Post
 * @author Jacopo Nardiello
 */
class Post implements Executable
{
    public function execute(array $params)
    {
        $user = $params['user'];
        $message = $params['target'];
        $user->post($message);
    }
}
