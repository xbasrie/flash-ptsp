<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;
    protected function afterCreate(): void
    {
        $role = $this->record;
        $data = $this->data;

        $permissions = [];
        foreach ($data as $key => $value) {
            if (\Illuminate\Support\Str::startsWith($key, 'permissions_') && is_array($value)) {
                $permissions = array_merge($permissions, $value);
            }
        }

        foreach ($permissions as $permissionName) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permissionName]);
        }

        $role->syncPermissions($permissions);
    }
}
