<?php

namespace App\Filament\Resources\KarisKarsuSubmissionResource\Pages;

use App\Filament\Resources\KarisKarsuSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKarisKarsuSubmissions extends ListRecords
{
    protected static string $resource = KarisKarsuSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
