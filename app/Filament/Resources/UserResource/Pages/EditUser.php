<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    use \App\Traits\LogsViewAccess;

    protected static string $resource = UserResource::class;

    public function mount($record): void
    {
        parent::mount($record);
        $this->logViewAccess();
    }
}
