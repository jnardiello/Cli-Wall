<?php

namespace TwiCli;

/**
 * Class Message
 * @author Jacopo Nardiello
 */
class Message
{
    private $message;
    private $age;

    public function __construct($message)
    {
        $this->message = $message;
        $this->age = time();
    }

    public function getValue()
    {
        return $this->message;
    }

    public function getAge()
    {
        return $this->prettyRange($this->age);
    }

    private function prettyRange($timestamp)
    {
        $now = time();
        $timeRangeSecs = ($now - $this->age) ? $now - $this->age : 1;

        $minutes = floor($timeRangeSecs/60);
        $hours = floor($timeRangeSecs/(60*60));
        $days = floor($timeRangeSecs/(60*60*24));
        $years = floor($days/365);

        if ($days > 365)
            return $days . " days ago";
        elseif ($hours)
            return $hours . "hours ago";
        elseif ($minutes)
            return $minutes . " minutes ago";
        else
            return $timeRangeSecs . " seconds ago";
    }
}
