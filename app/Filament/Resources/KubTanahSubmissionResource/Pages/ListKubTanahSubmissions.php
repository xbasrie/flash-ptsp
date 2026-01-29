<?php

namespace App\Filament\Resources\KubTanahSubmissionResource\Pages;

use App\Filament\Resources\KubTanahSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKubTanahSubmissions extends ListRecords
{
    protected static string $resource = KubTanahSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
