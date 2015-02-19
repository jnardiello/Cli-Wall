<?php

namespace TwiCli;

/**
 * Class TwiCli
 * @author Jacopo Nardiello
 */
class TwiCli
{
    // To add a new action:
    // 'placeholder' => <private method name to be called>
    private $availableCommands = [
        '->' => 'post',
        '' => 'timeline',
        'follows' => 'follows',
        'wall' => 'wall',
    ];
    private $users = [];

    public function process($input)
    {
        $input = explode(' ', $input);
        $name = $input[0];
        $rawCmd = (isset($input[1])) ? $input[1] : '';

        $command = $this->availableCommands[$rawCmd]; // ex. '->' - 'post'
        $this->$command($name, $input); // $this->post(...)
    }

    public function run()
    {
        do {
            echo '> ';
            $input = trim(fgets(STDIN));
            $this->process($input);
        } while($input != 'quit');
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
}
