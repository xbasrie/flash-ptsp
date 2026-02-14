<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Filament\Facades\Filament;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $resources = Filament::getResources();

        foreach ($resources as $resource) {
            if ($resource === \App\Filament\Resources\RoleResource::class || $resource === \App\Filament\Resources\UserResource::class) {
                continue;
            }

            $permissionName = 'view_any_' . Str::snake(Str::replaceLast('Resource', '', class_basename($resource)));
            Permission::firstOrCreate(['name' => $permissionName]);
        }
    }
}
