<?php

namespace App\Filament\Resources\KenaikanPangkatSubmissionResource\Pages;

use App\Filament\Resources\KenaikanPangkatSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKenaikanPangkatSubmissions extends ListRecords
{
    protected static string $resource = KenaikanPangkatSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
