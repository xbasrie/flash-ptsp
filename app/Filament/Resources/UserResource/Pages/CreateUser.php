<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        \App\Services\ActivityLogger::log(
            'created',
            'Membuat user baru: ' . $this->record->name,
            $this->record
        );
    }
}
