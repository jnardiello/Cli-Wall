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
    private $author;

    public function __construct($message, User $author)
    {
        $this->message = $message;
        $this->creationDate = time();
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author->getName();
    }

    public function getValue()
    {
        return $this->message;
    }

    public function getTimestamp()
    {
        return $this->creationDate;
    }

    public function getAge()
    {
        return $this->prettyRange($this->creationDate);
    }

    private function prettyRange($timestamp)
    {
        $now = time();
        $timeRangeSecs = ($now - $timestamp) ? $now - $timestamp : 1;

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
