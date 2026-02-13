<?php

namespace App\Filament\Resources\CutiSubmissionResource\Pages;

use App\Filament\Resources\CutiSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCutiSubmission extends EditRecord
{
    use \App\Traits\LogsViewAccess;

    protected static string $resource = CutiSubmissionResource::class;

    public function mount($record): void
    {
        parent::mount($record);
        $this->logViewAccess();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
