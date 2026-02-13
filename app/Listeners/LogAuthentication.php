<?php

namespace App\Listeners;

use App\Services\ActivityLogger;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Events\Dispatcher;

class LogAuthentication
{
    public function handleLogin(Login $event)
    {
        ActivityLogger::log('login', 'User logged in', $event->user);
    }

    public function handleLogout(Logout $event)
    {
        if ($event->user) {
            ActivityLogger::log('logout', 'User logged out', $event->user);
        }
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            Login::class => 'handleLogin',
            Logout::class => 'handleLogout',
        ];
    }
}
