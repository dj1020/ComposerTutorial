<?php

namespace MyCart\Storage;

class SessionStore extends \Cart\Storage\SessionStore
{
    /**
     * SessionStore constructor.
     */
    public function __construct()
    {
        echo "Session Store started." . PHP_EOL;
    }
}