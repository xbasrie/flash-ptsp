<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    use \App\Traits\LogsViewAccess;

    protected static string $resource = RoleResource::class;

    public function mount($record): void
    {
        parent::mount($record);
        $this->logViewAccess();
    }
}
