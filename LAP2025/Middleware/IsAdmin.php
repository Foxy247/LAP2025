<?php

namespace Middleware;

class IsAdmin
{
    public static function handle(): bool
    {
        $user = $_SESSION['user'] ?? null;
        if (!$user) {
            return false;
        }

        return $user['is_admin'] == 1;
    }
}
