<?php

namespace App\Filament\Resources\BimasIslamMasjidSubmissionResource\Pages;

use App\Filament\Resources\BimasIslamMasjidSubmissionResource;
use Filament\Resources\Pages\ListRecords;

class ListBimasIslamMasjidSubmissions extends ListRecords
{
    protected static string $resource = BimasIslamMasjidSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
