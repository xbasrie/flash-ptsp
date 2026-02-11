<?php

namespace App\Filament\Resources\UsulDataSiasnSubmissionResource\Pages;

use App\Filament\Resources\UsulDataSiasnSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsulDataSiasnSubmissions extends ListRecords
{
    protected static string $resource = UsulDataSiasnSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
           // Actions\CreateAction::make(),
        ];
    }
}
