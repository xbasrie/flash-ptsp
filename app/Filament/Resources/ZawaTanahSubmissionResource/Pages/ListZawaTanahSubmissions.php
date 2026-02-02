<?php

namespace App\Filament\Resources\ZawaTanahSubmissionResource\Pages;

use App\Filament\Resources\ZawaTanahSubmissionResource;
use Filament\Resources\Pages\ListRecords;

class ListZawaTanahSubmissions extends ListRecords
{
    protected static string $resource = ZawaTanahSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
