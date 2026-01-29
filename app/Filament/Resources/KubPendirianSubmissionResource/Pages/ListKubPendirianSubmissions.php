<?php

namespace App\Filament\Resources\KubPendirianSubmissionResource\Pages;

use App\Filament\Resources\KubPendirianSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKubPendirianSubmissions extends ListRecords
{
    protected static string $resource = KubPendirianSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
