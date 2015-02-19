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
        '' => 'Timeline',
        'follows' => 'Follows',
        'wall' => 'Wall',
    ];
    private $users = [];

    public function process($input)
    {
        $params = $this->parameters($input);
        $class = 
            self::ACTIONS_NAMESPACE . 
            $this->availableCommands[$params['cmd']];

        $action = new $class();
        $action->execute($params);
    }

    public function run()
    {
        do {
            echo '> ';
            $input = trim(fgets(STDIN));
            $this->process($input);
        } while($input != 'quit');
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

        foreach ($this->users as $name => $targetUser) {
            if (ucfirst($target) == $name)
                $target = $targetUser;
        }

        return [
            'user' => $user,
            'cmd' => $cmd,
            'target' => $target,
        ];
    }
}
