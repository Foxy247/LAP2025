<?php

namespace Middleware;

class IsUser
{

    public static function handle(): bool
    {
        return isset($_SESSION['user']);
    }

}