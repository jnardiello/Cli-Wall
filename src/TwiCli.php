<?php

namespace TwiCli;

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
        $params = $this->prettyParams($input);
        $class = 
            self::ACTIONS_NAMESPACE . 
            $this->availableCommands[$params['cmd']];

        $action = new $class();
        $action->execute($params);
    }

    public function getUsers()
    {
        return $this->users;
    }

    // Ensire that we add a user once and only once
    private function findUser($currentName)
    {
        foreach ($this->users as $name => $user) {
            if (ucfirst($currentName) == $name) {
                return $user;
            }
        }

        $newUser = new User($currentName);
        $this->users[$newUser->getName()] = $newUser;
        return $newUser;
    }

    private function prettyParams($input)
    {
        $input = explode(' ', $input);
        $user = $this->findUser($input[0]);
        $cmd = (isset($input[1])) ? $input[1] : '';
        $target = implode(' ', array_slice($input, 2));

        // target will be either a string or a user object depending on action
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
