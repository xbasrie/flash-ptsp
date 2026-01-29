<?php

namespace App\Filament\Resources\KubRohaniawanSubmissionResource\Pages;

use App\Filament\Resources\KubRohaniawanSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKubRohaniawanSubmissions extends ListRecords
{
    protected static string $resource = KubRohaniawanSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
