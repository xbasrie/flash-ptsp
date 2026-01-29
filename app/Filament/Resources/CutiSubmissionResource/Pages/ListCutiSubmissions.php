<?php

namespace App\Filament\Resources\CutiSubmissionResource\Pages;

use App\Filament\Resources\CutiSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCutiSubmissions extends ListRecords
{
    protected static string $resource = CutiSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
