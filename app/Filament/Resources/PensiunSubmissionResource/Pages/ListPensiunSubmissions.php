<?php

namespace App\Filament\Resources\PensiunSubmissionResource\Pages;

use App\Filament\Resources\PensiunSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPensiunSubmissions extends ListRecords
{
    protected static string $resource = PensiunSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
