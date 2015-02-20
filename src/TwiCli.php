<?php

namespace TwiCli;

/**
 * Class TwiCli
 * @author Jacopo Nardiello
 */
class TwiCli
{
    const ACTIONS_NAMESPACE = '\\TwiCli\\Actions\\';

    private $users = [];
    private $availableCommands = [
        '->' => 'Post',
        '' => 'Timeline',
        'follows' => 'Follows',
        'wall' => 'Wall',
    ];

    public function run($input = null)
    {
        do {
            echo '> ';
            $input = trim(fgets(STDIN));
            $this->process($input);
        } while ($input != 'quit');
    }

    public function process($input)
    {
        $params = $this->prettyParams($input);

        if ($this->commandIsDefined($params['cmd'])) {
            $actionName = $this->availableCommands[$params['cmd']];
            $class = self::ACTIONS_NAMESPACE . $actionName;
            $action = new $class();

            $action->execute($params);
        }
    }

    private function commandIsDefined($command)
    {
        if (!array_key_exists($command, $this->availableCommands)) {
            echo "The command you typed doesn't exist. Try again.\n";
            return false;
        }

        return true;
    }

    private function findUser($currentName)
    {
        $sanitizedName = ucfirst($currentName);
        foreach ($this->users as $name => $user) {
            if ($sanitizedName == $name) {
                return $user;
            }
        }

        $newUser = new User($sanitizedName);
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
