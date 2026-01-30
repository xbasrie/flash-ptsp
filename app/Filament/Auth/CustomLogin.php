<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login;

class CustomLogin extends Login
{
    protected static string $view = 'filament.auth.custom-login';

    public function getLayout(): string
    {
        return 'filament-panels::components.layout.base';
    }
}
