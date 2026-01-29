<?php

namespace App\Filament\Resources\SkppSkmiSubmissionResource\Pages;

use App\Filament\Resources\SkppSkmiSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSkppSkmiSubmissions extends ListRecords
{
    protected static string $resource = SkppSkmiSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
