<?php

namespace App\Filament\Resources\SatyaLencanaSubmissionResource\Pages;

use App\Filament\Resources\SatyaLencanaSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSatyaLencanaSubmissions extends ListRecords
{
    protected static string $resource = SatyaLencanaSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
