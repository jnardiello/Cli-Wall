<?php

namespace TwiCli;

use TwiCli\Actions\Post;

/**
 * Class TwiCli
 * @author Jacopo Nardiello
 */
class TwiCli
{
    const ACTIONS_NAMESPACE = '\\TwiCli\\Actions\\';
    // To add a new action:
    // 'placeholder' => <private method name to be called>
    private $availableCommands = [
        '->' => 'Post',
        '' => 'timeline',
        'follows' => 'follows',
        'wall' => 'wall',
    ];
    private $users = [];

    public function process($input)
    {
        $params = $this->parameters($input);
        $cmd = $params['cmd'];
        $method = $this->availableCommands[$cmd]; // ex. '->' - 'post'
        $actionName = self::ACTIONS_NAMESPACE . $method;
        $action = new $actionName();
        $action->execute($params);

        /* $this->$method($params); // $this->post(...) */
    }

    public function run()
    {
        do {
            echo '> ';
            $input = trim(fgets(STDIN));
            $this->process($input);
        } while($input != 'quit');
    }

    private function follows($params)
    {
        $target = $params['target'];
        $user = $params['user'];
        $followingUser = $this->findUser($target);

        $user->follow($followingUser);
    }

    private function wall($params)
    {
        $user = $params['user'];
        $wall = $user->wall();

        foreach ($wall as $message) {
            echo "{$message->getAuthor()} - {$message->getValue()} ({$message->getAge()})\n";
        }
    }

    private function timeline($params)
    {
        $user = $params['user'];
        foreach ($user->getMessages() as $message) {
            // test message (1 seconds ago)
            echo "{$message->getValue()} ({$message->getAge()})\n";
        }
    }

    // Ensire that we add a user once and only once
    private function findUser($currentName)
    {
        $sanitizedUsername = ucfirst($currentName); // insensitive to first letter
        foreach ($this->users as $name => $user) {
            if ($sanitizedUsername == $name) {
                return $user;
            }
        }

        $newUser = new User($currentName);
        $this->users[$newUser->getName()] = $newUser;
        return $newUser;
    }

    public function getUsers()
    {
        return $this->users;
    }

    private function parameters($input)
    {
        $input = explode(' ', $input);
        $user = $this->findUser($input[0]);
        $cmd = (isset($input[1])) ? $input[1] : '';
        $target = implode(' ', array_slice($input, 2));

        return [
            'user' => $user,
            'cmd' => $cmd,
            'target' => $target,
        ];
    }
}
