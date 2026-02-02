<?php

namespace App\Filament\Resources\ZawaNadzirSubmissionResource\Pages;

use App\Filament\Resources\ZawaNadzirSubmissionResource;
use Filament\Resources\Pages\ListRecords;

class ListZawaNadzirSubmissions extends ListRecords
{
    protected static string $resource = ZawaNadzirSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
