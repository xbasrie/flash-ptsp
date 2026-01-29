<?php

namespace App\Filament\Resources\JenjangJfSubmissionResource\Pages;

use App\Filament\Resources\JenjangJfSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenjangJfSubmissions extends ListRecords
{
    protected static string $resource = JenjangJfSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
