<?php

namespace TwiCli;

/**
 * Class TwiCli
 * @author Jacopo Nardiello
 */
class TwiCli
{
    private $users = [];
    // To add a new action:
    // 'placeholder' => <private method name to be called>
    private $cmds = [
        '->' => 'post',
        '' => 'timeline',
        'follows' => 'follows',
        'wall' => 'wall',
    ];

    public function process($input)
    {
        $input = explode(' ', $input);
        $name = $input[0];
        $cmd = (isset($input[1])) ? $input[1] : '';

        $command = $this->cmds[$cmd];
        $this->$command($name, $input);
    }

    private function post($name, $input)
    {
        $message = implode(' ', array_slice($input, 2));

        $user = $this->findUser($name);
        $user->post($message);
    }

    private function follows($name, $input)
    {
        $target = $input[2];

        $user = $this->findUser($name);
        $followingUser = $this->findUser($target);

        $user->follow($followingUser);
    }

    private function wall($name)
    {
        $user = $this->findUser($name);
        $wall = $user->wall();

        foreach ($wall as $message) {
            echo "{$message->getAuthor()} - {$message->getValue()} ({$message->getAge()})\n";
        }
    }

    private function timeline($name)
    {
        $user = $this->findUser($name);
        foreach ($user->getMessages() as $message) {
            // test message (1 seconds ago)
            echo "{$message->getValue()} ({$message->getAge()})\n";
        }
    }

    public function run()
    {
        do {
            echo '> ';
            $input = trim(fgets(STDIN));
            $this->process($input);
        } while($input != 'quit');
    }

    private function findUser($currentName)
    {
        // If user already exist let's just return it
        foreach ($this->users as $name => $user) {
            if ($currentName == $name) {
                return $user;
            }
        }

        // Otherwise we add it and return it
        $newUser = new User($currentName);
        $this->users[$newUser->getName()] = $newUser;
        return $newUser;
    }

    public function getUsers()
    {
        return $this->users;
    }
}
