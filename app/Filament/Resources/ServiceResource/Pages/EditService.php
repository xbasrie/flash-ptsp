<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    use \App\Traits\LogsViewAccess;

    protected static string $resource = ServiceResource::class;

    public function mount($record): void
    {
        parent::mount($record);
        $this->logViewAccess();
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
