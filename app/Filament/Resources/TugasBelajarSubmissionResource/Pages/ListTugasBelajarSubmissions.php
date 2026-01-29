<?php

namespace App\Filament\Resources\TugasBelajarSubmissionResource\Pages;

use App\Filament\Resources\TugasBelajarSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTugasBelajarSubmissions extends ListRecords
{
    protected static string $resource = TugasBelajarSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
