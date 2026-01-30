<?php

namespace App\Filament\Resources\BimasIslamMajelisTaklimSubmissionResource\Pages;

use App\Filament\Resources\BimasIslamMajelisTaklimSubmissionResource;
use Filament\Resources\Pages\ListRecords;

class ListBimasIslamMajelisTaklimSubmissions extends ListRecords
{
    protected static string $resource = BimasIslamMajelisTaklimSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
