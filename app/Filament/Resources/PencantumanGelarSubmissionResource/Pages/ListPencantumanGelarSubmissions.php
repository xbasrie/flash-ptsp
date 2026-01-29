<?php

namespace App\Filament\Resources\PencantumanGelarSubmissionResource\Pages;

use App\Filament\Resources\PencantumanGelarSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPencantumanGelarSubmissions extends ListRecords
{
    protected static string $resource = PencantumanGelarSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
