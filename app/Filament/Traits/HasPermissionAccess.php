<?php

namespace App\Filament\Traits;

use Illuminate\Support\Str;

trait HasPermissionAccess
{
    public static function canAccess(): bool
    {
        $user = auth()->user();

        if ($user->hasRole('super admin')) {
            return true;
        }

        return $user->can('view_any_' . static::getPermissionSlug());
    }

    public static function getPermissionSlug(): string
    {
        // Default behavior: slugify the model name or resource name
        // Example: CutiSubmissionResource -> cuti_submission
        return Str::snake(Str::replaceLast('Resource', '', class_basename(static::class)));
    }
}
