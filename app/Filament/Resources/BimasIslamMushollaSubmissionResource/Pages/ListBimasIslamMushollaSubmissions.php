<?php

namespace App\Filament\Resources\BimasIslamMushollaSubmissionResource\Pages;

use App\Filament\Resources\BimasIslamMushollaSubmissionResource;
use Filament\Resources\Pages\ListRecords;

class ListBimasIslamMushollaSubmissions extends ListRecords
{
    protected static string $resource = BimasIslamMushollaSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
